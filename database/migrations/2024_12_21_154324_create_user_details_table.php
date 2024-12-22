<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id(); // Cột id tự tăng
            $table->unsignedBigInteger('user_id'); // Khóa ngoại liên kết với bảng users
            $table->string('full_name')->nullable();
            $table->enum('sex', ['Nam', 'Nữ', 'LGBT'])->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('face_data')->nullable();
            $table->string('identity_card')->nullable();
            $table->string('student_id')->nullable();
            $table->string('university')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable(); // Khóa ngoại liên kết với bảng faculties
            $table->unsignedBigInteger('class_id')->nullable();   // Khóa ngoại liên kết với bảng classes
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details'); // Xóa bảng nếu rollback
    }
}
