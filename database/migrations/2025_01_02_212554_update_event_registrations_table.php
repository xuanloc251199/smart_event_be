<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEventRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Thêm cột `is_register`
            $table->boolean('is_register')->default(false)->after('event_id');

            // Chỉnh sửa cột `status` chỉ còn `checked_in` và `absent`
            $table->enum('status', ['checked_in', 'absent'])
                ->nullable()
                ->default(null)
                ->change();
        });
    }

    public function down()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Xóa cột `is_register`
            $table->dropColumn('is_register');

            // Khôi phục cột `status` về trạng thái ban đầu
            $table->enum('status', ['registered', 'checked_in', 'absent', 'no_register'])->default('no_register')->change();
        });
    }
}
