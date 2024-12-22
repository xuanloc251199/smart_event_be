<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitIdToUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable()->after('university'); // Thêm cột unit_id
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null'); // Ràng buộc khóa ngoại
        });
    }

    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropForeign(['unit_id']); // Xóa ràng buộc khóa ngoại
            $table->dropColumn('unit_id'); // Xóa cột unit_id
        });
    }
}
