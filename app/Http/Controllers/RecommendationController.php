<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RecommendationController extends Controller
{
    /**
     * Xuất dữ liệu ma trận tương tác User-Event
     */
    public function exportUserEventMatrix()
    {
        // Lấy danh sách người dùng và sự kiện
        $users = DB::table('user_details')->pluck('user_id');
        $events = DB::table('events')->pluck('id');

        // Lấy danh sách tương tác của người dùng với sự kiện
        $interactions = DB::table('event_registrations')
            ->select('user_id', 'event_id', 'is_register', 'status')
            ->get();

        $matrix = [];

        // Tạo ma trận
        foreach ($users as $user) {
            foreach ($events as $event) {
                $interaction = $interactions->filter(function ($interaction) use ($user, $event) {
                    return $interaction->user_id == $user && $interaction->event_id == $event;
                })->first();

                // Điểm tương tác:
                // - 2: Đã check-in
                // - 1: Đã đăng ký nhưng chưa check-in
                // - 0: Không có tương tác
                $score = 0;
                if ($interaction) {
                    $score = $interaction->status === 'checked_in' ? 2 : ($interaction->is_register ? 1 : 0);
                }

                $matrix[] = [
                    'user_id' => $user,
                    'event_id' => $event,
                    'interaction_score' => $score,
                ];
            }
        }

        // Xuất dữ liệu ra file CSV
        $csvFileName = 'user_event_matrix.csv';
        $filePath = storage_path('app/' . $csvFileName);

        $file = fopen($filePath, 'w');
        fputcsv($file, ['user_id', 'event_id', 'interaction_score']);

        foreach ($matrix as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        return response()->download($filePath);
    }

    public function trainModel()
    {
        $process = new Process(['python3', base_path('resources/ml/train_recommendation_model.py')]);

        $process->run();

        // Kiểm tra lỗi khi chạy process
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json(['message' => 'Model training completed!'], 200);
    }

    public function getRecommendations(Request $request)
    {
        $userId = $request->user()->id;

        $filePath = storage_path('app/public/datasets/recommendations.csv');

        if (!file_exists($filePath)) {
            return response()->json(['message' => 'Recommendations not found'], 404);
        }

        $recommendations = array_map('str_getcsv', file($filePath));
        $header = array_shift($recommendations);

        foreach ($recommendations as $row) {
            $rowData = array_combine($header, $row);

            if ((int)$rowData['user_id'] === $userId) {
                return response()->json(['recommended_events' => json_decode($rowData['recommended_events'])], 200);
            }
        }

        return response()->json(['message' => 'No recommendations found'], 404);
    }

    public function buildUserEventMatrix()
    {
        // Lấy danh sách người dùng và sự kiện
        $users = DB::table('users')->pluck('id');
        $events = DB::table('events')->pluck('id');

        // Tạo ma trận tương tác
        $matrix = [];
        foreach ($users as $user) {
            foreach ($events as $event) {
                $interaction = DB::table('event_registrations')
                    ->where('user_id', $user)
                    ->where('event_id', $event)
                    ->select('is_register', 'status')
                    ->first();

                if ($interaction) {
                    // Đánh giá mức độ tương tác
                    $score = ($interaction->is_register ? 1 : 0) + ($interaction->status === 'checked_in' ? 1 : 0);
                } else {
                    $score = 0;
                }

                $matrix[$user][$event] = $score;
            }
        }

        return $matrix;
    }

    public function recommendEvents($userId)
    {
        // Chạy mô hình Python
        $process = new Process(['python3', base_path('recommendation_model.py'), $userId]);
        $process->run();

        // Kiểm tra lỗi
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Lấy kết quả từ mô hình
        $recommendations = json_decode($process->getOutput(), true);

        return response()->json(['data' => $recommendations], 200);
    }
}
