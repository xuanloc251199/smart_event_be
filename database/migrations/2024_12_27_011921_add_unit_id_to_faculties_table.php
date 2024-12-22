<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitIdToFacultiesTable extends Migration
{
    public function up()
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable(); // Khóa ngoại liên kết bảng units
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
}