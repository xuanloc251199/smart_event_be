<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->unique(); // Tên vai trò (Admin, Student, Guest, etc.)
            $table->text('description')->nullable(); // Mô tả chi tiết vai trò
            $table->json('permissions')->nullable(); // Quyền hạn được lưu dưới dạng JSON
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}

