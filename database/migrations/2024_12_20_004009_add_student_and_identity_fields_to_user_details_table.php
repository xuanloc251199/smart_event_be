<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentAndIdentityFieldsToUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('identity_card')->nullable(); // Số căn cước công dân
            $table->string('student_id')->nullable();    // Mã sinh viên
            $table->string('university')->nullable();    // Tên trường đại học
            $table->string('faculty')->nullable();       // Tên khoa
            $table->string('class')->nullable();         // Tên chi đoàn/lớp
        });
    }

    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn([
                'identity_card',
                'student_id',
                'university',
                'faculty',
                'class',
            ]);
        });
    }
}
