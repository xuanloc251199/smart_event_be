<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDetailSeeder extends Seeder
{
    public function run()
    {
        // Danh sách user_id từ 2 đến 22 (bỏ id 4)
        $userIds = range(2, 22);
        $userIds = array_filter($userIds, function ($id) {
            return $id !== 4;
        });

        // Các giá trị hợp lệ của cột `sex`
        $sexOptions = ['Nam', 'Nữ', 'LGBT'];

        foreach ($userIds as $userId) {
            DB::table('user_details')->insert([
                'user_id' => $userId,
                'full_name' => "User $userId",
                'sex' => $sexOptions[array_rand($sexOptions)], // Chọn ngẫu nhiên từ danh sách hợp lệ
                'phone' => '012345678' . $userId,
                'date_of_birth' => now()->subYears(rand(18, 30))->format('Y-m-d'),
                'address' => "Address for User $userId",
                'permanent_address' => "Permanent Address for User $userId",
                'avatar' => 'avatars/lDnLaKVopHGEPvahh5COWucENL9juxOMoLtFwWgc.jpg',
                'face_data' => null,
                'identity_card' => 'ID-' . str_pad($userId, 6, '0', STR_PAD_LEFT),
                'student_id' => 'ST-' . str_pad($userId, 6, '0', STR_PAD_LEFT),
                'unit_id' => null,
                'faculty_id' => null,
                'class_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
