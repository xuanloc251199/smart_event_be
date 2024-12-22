<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'description' => 'Quản trị viên toàn hệ thống, có toàn quyền.',
                'permissions' => json_encode([
                    'create_event' => true,
                    'delete_event' => true,
                    'manage_users' => true,
                    'access_reports' => true,
                ]),
            ],
            [
                'name' => 'EventOrganizer',
                'description' => 'Người tổ chức sự kiện, quản lý các sự kiện.',
                'permissions' => json_encode([
                    'create_event' => true,
                    'delete_event' => false,
                    'manage_users' => false,
                    'access_reports' => true,
                ]),
            ],
            [
                'name' => 'Student',
                'description' => 'Sinh viên tham gia sự kiện, nhận gợi ý sự kiện.',
                'permissions' => json_encode([
                    'view_recommendations' => true,
                    'check_in_event' => true,
                ]),
            ],
            [
                'name' => 'Guest',
                'description' => 'Khách mời tham gia sự kiện, có quyền check-in.',
                'permissions' => json_encode([
                    'check_in_event' => true,
                ]),
            ],
        ]);
    }
}
