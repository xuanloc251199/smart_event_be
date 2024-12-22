<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = range(1, 8);
        $faculties = range(1, 4);
        $thumbnail = 'https://dummyimage.com/600x400/000/fff';
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        for ($i = 1; $i <= 50; $i++) {
            DB::table('events')->insert([
                'title' => 'Event ' . $i,
                'date' => now()->addDays($i)->format('Y-m-d'),
                'start_time' => now()->setTime(rand(8, 12), rand(0, 59), 0)->format('H:i:s'),
                'end_time' => now()->setTime(rand(13, 17), rand(0, 59), 0)->format('H:i:s'),
                'location' => 'Location ' . $i,
                'thumbnail' => $thumbnail,
                'description' => $description,
                'category_id' => $categories[array_rand($categories)],
                'faculty_id' => $faculties[array_rand($faculties)],
            ]);
        }
    }
}
