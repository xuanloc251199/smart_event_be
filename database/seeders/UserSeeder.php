<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $password = bcrypt('123456'); // Mã hóa mật khẩu

        $users = [];
        for ($i = 5; $i <= 20; $i++) {
            $users[] = [
                'username' => 'user' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        User::insert($users); // Chèn nhiều bản ghi cùng lúc
    }
}
