<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function show(Request $request)
    {
        // Lấy user từ token
        $user = $request->user();

        // Lấy thông tin chi tiết của user kèm unit, faculty, và class
        $userDetail = UserDetail::with(['unit', 'faculty', 'class'])->where('user_id', $user->id)->first();

        if (!$userDetail) {
            return response()->json(['message' => 'User detail not found.'], 404);
        }

        // Chuẩn bị dữ liệu để trả về
        $data = [
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'full_name' => $userDetail->full_name,
            'sex' => $userDetail->sex,
            'phone' => $userDetail->phone,
            'date_of_birth' => $userDetail->date_of_birth
                ? Carbon::parse($userDetail->date_of_birth)->format('d-m-Y')
                : null,
            'address' => $userDetail->address,
            'face_data' => $userDetail->face_data,
            'permanent_address' => $userDetail->permanent_address,
            'avatar' => $userDetail->avatar ? url('storage/' . $userDetail->avatar) : null,
            'identity_card' => $userDetail->identity_card,
            'student_id' => $userDetail->student_id,
            'unit_id' => $userDetail->unit_id,
            'faculty_id' => $userDetail->faculty_id,
            'class_id' => $userDetail->class_id,
        ];

        return response()->json(['data' => $data], 200);
    }



    // Thêm thông tin chi tiết
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'sex' => 'nullable|in:Nam,Nữ,LGBT',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'nullable|date_format:d-m-Y',
            'address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'identity_card' => 'nullable|string|max:20',
            'student_id' => 'nullable|string|max:20',
            'university' => 'nullable|string|max:255',
            'faculty_id' => 'nullable|exists:faculties,id',
            'class_id' => 'nullable|exists:classes,id',
        ]);

        // Lấy thông tin user từ token
        $user = $request->user();

        // Kiểm tra nếu thông tin chi tiết đã tồn tại
        if ($user->detail) {
            return response()->json(['message' => 'User detail already exists. Use update instead.'], 400);
        }

        // Xử lý avatar nếu có
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Chuyển đổi định dạng ngày sinh
        if (isset($validated['date_of_birth'])) {
            $validated['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $validated['date_of_birth'])->format('Y-m-d');
        }

        // Tạo thông tin chi tiết người dùng
        $detail = $user->detail()->create($validated);

        // Chuẩn bị dữ liệu trả về
        $response = [
            'id' => $detail->id,
            'full_name' => $detail->full_name,
            'sex' => $detail->sex,
            'phone' => $detail->phone,
            'date_of_birth' => $detail->date_of_birth
                ? Carbon::parse($detail->date_of_birth)->format('d-m-Y')
                : null,
            'address' => $detail->address,
            'permanent_address' => $detail->permanent_address,
            'avatar' => $detail->avatar ? url('storage/' . $detail->avatar) : null,
            'identity_card' => $detail->identity_card,
            'student_id' => $detail->student_id,
            'university' => $detail->university,
            'faculty' => $detail->faculty ? $detail->faculty->faculty : null,
            'class' => $detail->class ? $detail->class->class_name : null,
        ];

        return response()->json(['message' => 'User detail created successfully', 'data' => $response], 201);
    }

    // Sửa thông tin chi tiết
    public function updateUserDetail(Request $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'full_name' => 'nullable|string|max:255',
            'sex' => 'nullable|in:Nam,Nữ,LGBT',
            'phone' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date_format:Y-m-d',
            'address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'identity_card' => 'nullable|string|max:20',
            'student_id' => 'nullable|string|max:20',
            'unit_id' => 'nullable|exists:units,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'class_id' => 'nullable|exists:classes,id',
            'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm avatar
        ]);

        // Lấy thông tin user hiện tại từ token
        $user = Auth::user();
        $userDetail = $user->detail;

        // Nếu user_detail không tồn tại, tạo mới
        if (!$userDetail) {
            if ($request->hasFile('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }
            $userDetail = UserDetail::create(array_merge($validated, ['user_id' => $user->id]));
            return response()->json([
                'message' => 'User detail created successfully',
                'data' => $this->formatUserDetailResponse($userDetail),
            ], 201);
        }

        // Nếu avatar có trong request, cập nhật
        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu tồn tại
            if ($userDetail->avatar && Storage::exists('public/' . $userDetail->avatar)) {
                Storage::delete('public/' . $userDetail->avatar);
            }

            // Lưu avatar mới
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Cập nhật thông tin user_detail
        $userDetail->update($validated);

        return response()->json([
            'message' => 'User detail updated successfully',
            'data' => $this->formatUserDetailResponse($userDetail),
        ], 200);
    }

    /**
     * Định dạng phản hồi chi tiết người dùng.
     */
    private function formatUserDetailResponse(UserDetail $userDetail)
    {
        return [
            'id' => $userDetail->id,
            'full_name' => $userDetail->full_name,
            'sex' => $userDetail->sex,
            'phone' => $userDetail->phone,
            'date_of_birth' => $userDetail->date_of_birth
                ? Carbon::parse($userDetail->date_of_birth)->format('d-m-Y')
                : null,
            'address' => $userDetail->address,
            'permanent_address' => $userDetail->permanent_address,
            'identity_card' => $userDetail->identity_card,
            'student_id' => $userDetail->student_id,
            'unit' => $userDetail->unit
                ? ['id' => $userDetail->unit->id, 'abbreviation' => $userDetail->unit->abbreviation]
                : null,
            'faculty' => $userDetail->faculty ? $userDetail->faculty->faculty : null,
            'class' => $userDetail->class ? $userDetail->class->class_name : null,
        ];
    }


    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $userDetail = $user->detail;

        // Lưu ảnh avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filePath = $file->store('avatars', 'public'); // Lưu vào thư mục public/avatars

            // Cập nhật đường dẫn avatar vào database
            $userDetail->update(['avatar' => $filePath]);
        }

        return response()->json(['message' => 'Avatar updated successfully', 'avatar' => $userDetail->avatar]);
    }

    // public function saveFaceData(Request $request)
    // {
    //     $request->validate([
    //         'face_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     $user = Auth::user();
    //     $userDetail = $user->detail;

    //     if (!$userDetail) {
    //         return response()->json([
    //             'message' => 'User detail not found. Please complete your profile first.',
    //         ], 404);
    //     }

    //     try {
    //         if ($request->hasFile('face_image')) {
    //             $file = $request->file('face_image');

    //             // Xóa ảnh khuôn mặt cũ nếu tồn tại
    //             if ($userDetail->face_data && Storage::exists('public/' . $userDetail->face_data)) {
    //                 Storage::delete('public/' . $userDetail->face_data);
    //             }

    //             // Lưu ảnh mới
    //             $filePath = $file->store('faces', 'public');
    //             $userDetail->update(['face_data' => $filePath]);

    //             return response()->json([
    //                 'message' => 'Face data saved successfully.',
    //                 'face_data_url' => asset('storage/' . $filePath),
    //             ], 200);
    //         } else {
    //             return response()->json(['message' => 'No face image uploaded.'], 400);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Failed to save face data.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // Lưu file ảnh khuôn mặt (face_data)
    // public function saveFaceData(Request $request)
    // {
    //     $request->validate([
    //         'face_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     $user = Auth::user();
    //     $userDetail = $user->detail;

    //     if (!$userDetail) {
    //         return response()->json([
    //             'message' => 'User detail not found. Please complete your profile first.',
    //         ], 404);
    //     }

    //     try {
    //         if ($request->hasFile('face_image')) {
    //             // Xoá face_data cũ (nếu có)
    //             if ($userDetail->face_data && Storage::exists('public/' . $userDetail->face_data)) {
    //                 Storage::delete('public/' . $userDetail->face_data);
    //             }

    //             // Lưu file ảnh mới
    //             $filePath = $request->file('face_image')->store('faces', 'public');
    //             // Update DB
    //             $userDetail->update(['face_data' => $filePath]);

    //             return response()->json([
    //                 'message' => 'Face data saved successfully.',
    //                 'face_data_url' => asset('storage/' . $filePath),
    //             ], 200);
    //         } else {
    //             return response()->json(['message' => 'No face image uploaded.'], 400);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Failed to save face data.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // // Xác thực khuôn mặt (dummy so sánh filePath cũ & mới)
    // public function verifyFaceData(Request $request)
    // {
    //     $request->validate([
    //         'face_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     $user = Auth::user();
    //     $userDetail = $user->detail;

    //     if (!$userDetail || !$userDetail->face_data) {
    //         return response()->json([
    //             'message' => 'No face data found. Please register your face first.'
    //         ], 404);
    //     }

    //     try {
    //         // Lưu file tạm
    //         $tempPath = $request->file('face_image')->store('temp_faces', 'public');

    //         // DUMMY: so sánh tên file (hoặc size, v.v.). Tất nhiên, so sánh fileName là “không chính xác”.  
    //         // Thực tế, bạn cần AI. Ở đây minh họa logic “khớp = success” nếu 2 fileName = nhau.
    //         $oldFace = basename($userDetail->face_data);      // e.g. "abc.jpg"
    //         $newFace = basename($tempPath);                   // e.g. "xyz.jpg"

    //         if ($oldFace === $newFace) {
    //             // Xóa file tạm
    //             Storage::delete('public/' . $tempPath);

    //             return response()->json([
    //                 'message' => 'Face matched!',
    //                 'status'  => true,
    //             ], 200);
    //         } else {
    //             // Xóa file tạm
    //             Storage::delete('public/' . $tempPath);

    //             return response()->json([
    //                 'message' => 'Face not matched!',
    //                 'status'  => false,
    //             ], 200);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Verification failed!',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function saveFaceData(Request $request)
    {
        $request->validate([
            'face_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $userDetail = $user->detail;

        if (!$userDetail) {
            return response()->json([
                'message' => 'User detail not found. Please complete your profile first.',
            ], 404);
        }

        try {
            if ($request->hasFile('face_image')) {
                $file = $request->file('face_image');

                // Xóa ảnh khuôn mặt cũ nếu tồn tại
                if ($userDetail->face_data && Storage::exists('public/' . $userDetail->face_data)) {
                    Storage::delete('public/' . $userDetail->face_data);
                }

                // Lưu ảnh mới
                $filePath = $file->store('faces', 'public');
                $userDetail->update(['face_data' => $filePath]);

                // Tạo embedding và lưu vào database (giả sử có cột 'face_embedding' kiểu JSON)
                $embedding = $this->generateEmbedding(storage_path('app/public/' . $filePath));
                if ($embedding) {
                    $userDetail->update(['face_embedding' => json_encode($embedding)]);
                } else {
                    return response()->json(['message' => 'Failed to generate face embedding.'], 500);
                }

                return response()->json([
                    'message' => 'Face data saved successfully.',
                    'face_data_url' => asset('storage/' . $filePath),
                ], 200);
            } else {
                return response()->json(['message' => 'No face image uploaded.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to save face data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Tạo embedding từ ảnh khuôn mặt bằng cách gọi script Python.
     */
    private function generateEmbedding($imagePath)
    {
        $pythonPath = 'python'; // Đảm bảo Python đã được thêm vào PATH
        $scriptPath = base_path('app/Services/Python/generate_embedding.py');
        $command = escapeshellcmd("$pythonPath $scriptPath $imagePath");
        $output = shell_exec($command);
        if (!$output) {
            return null;
        }
        $result = json_decode($output, true);
        if ($result && $result['status']) {
            return $result['embedding'];
        }
        return null;
    }

    /**
     * Xác thực khuôn mặt bằng cách gọi script Python.
     */
    public function verifyFaceData(Request $request)
    {
        $request->validate([
            'face_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $userDetail = $user->detail;

        if (!$userDetail || !$userDetail->face_data || !$userDetail->face_embedding) {
            return response()->json([
                'message' => 'No face data found. Please register your face first.'
            ], 404);
        }

        try {
            if ($request->hasFile('face_image')) {
                // Lưu ảnh tạm
                $tempPath = $request->file('face_image')->store('temp_faces', 'public');
                $tempFullPath = storage_path('app/public/' . $tempPath);

                // Lấy đường dẫn ảnh đã lưu
                $savedFacePath = storage_path('app/public/' . $userDetail->face_data);

                // Gọi script Python để so sánh
                $matched = $this->verifyFace($savedFacePath, $tempFullPath);

                // Xóa ảnh tạm
                Storage::delete('public/' . $tempPath);

                if ($matched === null) {
                    return response()->json([
                        'message' => 'Face verification failed.',
                    ], 500);
                }

                if ($matched) {
                    return response()->json([
                        'message' => 'Face matched!',
                        'status' => true,
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Face not matched!',
                        'status' => false,
                    ], 200);
                }
            } else {
                return response()->json(['message' => 'No face image uploaded.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Face verification failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Gọi script Python để xác thực hai ảnh khuôn mặt.
     */
    private function verifyFace($savedFacePath, $newFacePath)
    {
        $pythonPath = 'python'; // Đảm bảo Python đã được thêm vào PATH
        $scriptPath = base_path('app/Services/Python/verify_face.py');
        $command = escapeshellcmd("$pythonPath $scriptPath $savedFacePath $newFacePath");
        $output = shell_exec($command);
        if (!$output) {
            return null;
        }
        $result = json_decode($output, true);
        if ($result && isset($result['status'])) {
            return $result['status'];
        }
        return null;
    }
}
