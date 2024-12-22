<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            ['class_name' => '21ITT', 'faculty_id' => 1],
            ['class_name' => '21SE1', 'faculty_id' => 1],
            ['class_name' => '21SE2', 'faculty_id' => 1],
            ['class_name' => '21SE3', 'faculty_id' => 1],
            ['class_name' => '21DA1', 'faculty_id' => 1],
            ['class_name' => '21DA2', 'faculty_id' => 1],
            ['class_name' => '21DA3', 'faculty_id' => 1],
            ['class_name' => '21ET1', 'faculty_id' => 2],
            ['class_name' => '21ET2', 'faculty_id' => 2],
            ['class_name' => '21ET3', 'faculty_id' => 2],
            ['class_name' => '21EL1', 'faculty_id' => 2],
            ['class_name' => '21EL2', 'faculty_id' => 2],
            ['class_name' => '21EL3', 'faculty_id' => 2],
            ['class_name' => '21CE1', 'faculty_id' => 3],
            ['class_name' => '21CE2', 'faculty_id' => 3],
            ['class_name' => '21CE3', 'faculty_id' => 3],
            ['class_name' => '21ES1', 'faculty_id' => 3],
            ['class_name' => '21ES2', 'faculty_id' => 3],
            ['class_name' => '21ES3', 'faculty_id' => 3],
        ];

        foreach ($classes as $class) {
            ClassModel::create($class);
        }
    }
}
