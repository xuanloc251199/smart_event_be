<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('title'); // Tiêu đề sự kiện
            $table->date('date'); // Ngày diễn ra sự kiện
            $table->string('location'); // Địa điểm tổ chức
            $table->string('thumbnail')->nullable(); // Ảnh đại diện
            $table->text('description')->nullable(); // Mô tả sự kiện
            $table->unsignedBigInteger('category_id'); // Khóa ngoại liên kết danh mục
            $table->unsignedBigInteger('faculty_id'); // Khóa ngoại liên kết người tổ chức
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
