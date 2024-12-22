<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Hiển thị danh sách sự kiện.
     */
    public function index()
    {
        $events = Event::with(['category', 'faculty', 'registrations.user'])->get();

        $data = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'date' => Carbon::parse($event->date)->format('d-m-Y'),
                'start_time' => $event->start_time,
                'end_time' => $event->end_time,
                'location' => $event->location,
                'thumbnail' => $event->thumbnail ? url('storage/' . $event->thumbnail) : null,
                'description' => $event->description,
                'category' => $event->category ? $event->category->name : null,
                'faculty' => $event->faculty
                    ? $event->faculty->faculty : null,
                'registrations' => $event->registrations
                    ->filter(function ($registration) {
                        return $registration->is_register == 1;
                    })
                    ->map(function ($registration) {
                        $user = $registration->user;
                        $userDetail = $user ? $user->detail : null;

                        return [
                            'user_id' => $user ? $user->id : $registration->user_id,
                            'full_name' => $user ? $user->username : 'Unknown User',
                            'avatar' => $userDetail && $userDetail->avatar
                                ? url('storage/' . $userDetail->avatar)
                                : url('storage/default_avatar.png'),
                            'is_register' => $registration->is_register,
                            'status' => $registration->status,
                        ];
                    }),
            ];
        });

        return response()->json(['data' => $data], 200);
    }

    /**
     * Hiển thị chi tiết sự kiện.
     */
    public function show($id)
    {
        $event = Event::with(['category', 'faculty', 'registrations.user'])->find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->date = Carbon::parse($event->date)->format('d-m-Y');

        $data = [
            'id' => $event->id,
            'title' => $event->title,
            'date' => $event->date,
            'start_time' => $event->start_time,
            'end_time' => $event->end_time,
            'location' => $event->location,
            'thumbnail' => $event->thumbnail ? url('storage/' . $event->thumbnail) : null,
            'description' => $event->description,
            'category' => $event->category ? $event->category->name : null,
            'faculty' => $event->faculty ? $event->faculty->faculty : null,
            'registrations' => $event->registrations
                ->filter(function ($registration) {
                    return $registration->is_register == 1;
                })
                ->map(function ($registration) {
                    $user = $registration->user;
                    $userDetail = $user ? $user->detail : null;

                    return [
                        'user_id' => $user ? $user->id : $registration->user_id,
                        'full_name' => $user ? $user->username : 'Unknown User',
                        'avatar' => $userDetail && $userDetail->avatar
                            ? url('storage/' . $userDetail->avatar)
                            : url('storage/default_avatar.png'),
                        'is_register' => $registration->is_register,
                        'status' => $registration->status,
                    ];
                }),
        ];

        return response()->json(['data' => $data], 200);
    }


    /**
     * Thêm sự kiện (chỉ admin).
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role_id !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date_format:d-m-Y',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        $validated['date'] = Carbon::createFromFormat('d-m-Y', $validated['date'])->format('Y-m-d');
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $event = Event::create($validated);

        return response()->json(['message' => 'Event created successfully', 'data' => $event], 201);
    }


    /**
     * Cập nhật sự kiện (chỉ admin).
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role_id !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date_format:d-m-Y',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $validated['date'] = Carbon::createFromFormat('d-m-Y', $validated['date'])->format('Y-m-d');
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $event->update($validated);

        return response()->json(['message' => 'Event updated successfully', 'data' => $event], 200);
    }

    /**
     * Xóa sự kiện (chỉ admin).
     */
    public function destroy($id)
    {
        $user = Auth::user();

        // Kiểm tra quyền admin
        if ($user->role_id !== 1) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully'], 200);
    }

    /**
     * Đăng ký tham gia sự kiện.
     */
    public function register(Request $request, $id)
    {
        $user = $request->user();

        // Tìm sự kiện dựa trên ID
        $event = Event::find($id);

        // Kiểm tra nếu sự kiện không tồn tại
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Kiểm tra nếu người dùng đã đăng ký trước đó
        $existingRegistration = EventRegistration::where('user_id', $user->id)
            ->where('event_id', $id)
            ->first();

        if ($existingRegistration) {
            return response()->json(['message' => 'User already registered for this event'], 400);
        }

        // Tạo mới hoặc cập nhật trạng thái đăng ký
        $registration = EventRegistration::updateOrCreate(
            ['user_id' => $user->id, 'event_id' => $id],
            [
                'is_register' => 1, // Đánh dấu đã đăng ký
                'status' => null, // Đặt giá trị mặc định cho status
            ]
        );

        // Xóa cache ma trận
        Cache::forget('user_event_matrix');

        return response()->json([
            'message' => 'Event registered successfully',
            'data' => [
                'event_id' => $event->id,
                'user_id' => $user->id,
                'is_register' => $registration->is_register,
                'status' => $registration->status,
            ]
        ], 200);
    }

    public function checkIn(Request $request, $id)
    {
        $user = $request->user();

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $registration = EventRegistration::where('user_id', $user->id)
            ->where('event_id', $id)
            ->first();

        if (!$registration) {
            return response()->json(['message' => 'User not registered for this event'], 400);
        }

        $currentTime = Carbon::now();
        $eventTime = Carbon::parse($event->date);

        if ($currentTime->diffInMinutes($eventTime) > 15) {
            return response()->json(['message' => 'Check-in time is over'], 403);
        }

        if ($registration->status === 'checked_in') {
            return response()->json(['message' => 'User already checked in'], 400);
        }

        $registration->update(['status' => 'checked_in']);

        return response()->json([
            'message' => 'User successfully checked in',
            'data' => $registration,
        ], 200);
    }

    public function recommendEvents(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Lấy `faculty_id` của người dùng từ bảng user_detail
        $userFacultyId = $user->detail->faculty_id ?? null;

        // Kiểm tra nếu `faculty_id` không tồn tại
        if (!$userFacultyId) {
            return response()->json(['message' => 'User does not have a faculty assigned'], 400);
        }

        // Lấy danh sách sự kiện mà người dùng đã tham gia với trạng thái `checked_in`
        $userCheckedInEvents = EventRegistration::where('user_id', $user->id)
            ->where('status', 'checked_in') // Lọc trạng thái là checked_in
            ->pluck('event_id'); // Lấy danh sách event_id

        // Gợi ý các sự kiện dựa trên:
        // - Cùng `faculty_id` với người dùng.
        // - Hoặc nằm trong danh sách sự kiện đã tham gia.
        $recommendedEvents = Event::where(function ($query) use ($userFacultyId, $userCheckedInEvents) {
            $query->where('faculty_id', $userFacultyId)
                ->orWhereIn('id', $userCheckedInEvents); // Bao gồm sự kiện đã tham gia
        })
            ->with(['category', 'faculty'])
            ->get();

        // Kiểm tra nếu không có sự kiện gợi ý
        if ($recommendedEvents->isEmpty()) {
            return response()->json(['message' => 'No recommended events found'], 404);
        }

        // Format dữ liệu trả về
        $data = $recommendedEvents->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'date' => Carbon::parse($event->date)->format('d-m-Y'),
                'start_time' => $event->start_time,
                'end_time' => $event->end_time,
                'location' => $event->location,
                'thumbnail' => $event->thumbnail ? url('storage/' . $event->thumbnail) : null,
                'description' => $event->description,
                'category' => $event->category ? $event->category->name : null,
                'faculty' => $event->faculty ? $event->faculty->faculty : 'Unknown Faculty',
            ];
        });

        return response()->json(['data' => $data], 200);
    }

    // Hàm xử lý ma trận tương tác (User-Event Matrix)
    public function buildUserEventMatrix()
    {
        // Tối ưu ma trận bằng cách lưu trữ cache
        // Kiểm tra xem ma trận đã được lưu vào cache chưa
        return Cache::remember('user_event_matrix', now()->addMinutes(60), function () {
            // Lấy danh sách tất cả người dùng
            $users = DB::table('users')->pluck('id');

            // Lấy danh sách tất cả sự kiện
            $events = DB::table('events')->pluck('id');

            // Khởi tạo ma trận tương tác với giá trị mặc định là 0
            $matrix = [];
            foreach ($users as $userId) {
                $matrix[$userId] = array_fill_keys($events->toArray(), 0);
            }

            // Lấy danh sách sự kiện mà người dùng đã check-in
            $checkedInEvents = DB::table('event_registrations')
                ->where('status', 'checked_in')
                ->select('user_id', 'event_id')
                ->get();

            // Cập nhật ma trận với dữ liệu check-in
            foreach ($checkedInEvents as $entry) {
                $matrix[$entry->user_id][$entry->event_id] = 1;
            }

            return $matrix;
        });
    }

    public function recommendEventsFromMatrix(Request $request)
    {
        // Lấy ID người dùng hiện tại
        $userId = $request->user()->id;

        // Lấy ma trận tương tác
        $matrix = $this->buildUserEventMatrix();

        // Kiểm tra nếu người dùng không tồn tại trong ma trận
        if (!isset($matrix[$userId])) {
            return response()->json(['message' => 'User not found in matrix'], 404);
        }

        // Lấy danh sách sự kiện mà người dùng đã tham gia
        $userEvents = $matrix[$userId];

        // Tìm các sự kiện mà người dùng chưa tham gia
        $recommendedEvents = [];
        foreach ($matrix as $otherUserId => $otherUserEvents) {
            if ($otherUserId != $userId) {
                foreach ($otherUserEvents as $eventId => $status) {
                    if ($status == 1 && $userEvents[$eventId] == 0) {
                        $recommendedEvents[$eventId] = ($recommendedEvents[$eventId] ?? 0) + 1;
                    }
                }
            }
        }

        // Sắp xếp các sự kiện gợi ý theo số lượt xuất hiện
        arsort($recommendedEvents);

        // Lấy thông tin sự kiện từ cơ sở dữ liệu
        $events = Event::whereIn('id', array_keys($recommendedEvents))->get();

        if ($events->isEmpty()) {
            return response()->json(['message' => 'No recommended events found'], 404);
        }

        return response()->json(['data' => $events], 200);
    }
}
