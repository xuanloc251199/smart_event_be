<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->string('username')->unique(); // Tên đăng nhập (duy nhất)
            $table->string('email')->unique(); // Email (duy nhất)
            $table->string('password'); // Mật khẩu (đã mã hóa)
            $table->unsignedBigInteger('role_id')->default(3)->change(); // Vai trò liên kết với bảng roles
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active'); // Trạng thái người dùng
            $table->timestamp('email_verified_at')->nullable(); // Thời gian xác thực email
            $table->string('remember_token')->nullable(); // Token để duy trì trạng thái đăng nhập
            $table->timestamps(); // created_at, updated_at

            // Khóa ngoại
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

