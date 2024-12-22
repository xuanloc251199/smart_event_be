<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // Cột id tự tăng
            $table->string('class_name')->unique(); // Cột class_name, giá trị duy nhất
            $table->unsignedBigInteger('faculty_id'); // Cột faculty_id, khóa ngoại
            $table->timestamps(); // Cột created_at và updated_at

            // Ràng buộc khóa ngoại
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes'); // Xóa bảng nếu rollback
    }
}

