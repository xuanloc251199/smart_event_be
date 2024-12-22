<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventRegistrationSeeder extends Seeder
{
    public function run()
    {
        $events = range(1, 10); // ID của các sự kiện
        $users = array_diff(range(1, 22), [2]); // ID của các user, loại trừ user_id = 2

        $registrations = [];

        foreach ($events as $event_id) {
            // Lấy số lượng user ngẫu nhiên từ 5 đến 10
            $userCount = rand(5, 10);

            // Lấy danh sách user ngẫu nhiên
            $randomUsers = collect($users)->random($userCount);

            foreach ($randomUsers as $user_id) {
                $registrations[] = [
                    'user_id' => $user_id,
                    'event_id' => $event_id,
                    'status' => collect(['registered', 'checked_in', 'absent'])->random(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        // Thêm dữ liệu vào bảng event_registrations
        DB::table('event_registrations')->insert($registrations);
    }
}
