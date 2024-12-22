<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->string('full_name', 255); // Tên đầy đủ
            $table->string('abbreviation', 50); // Tên viết tắt
            $table->text('description')->nullable(); // Mô tả
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
}