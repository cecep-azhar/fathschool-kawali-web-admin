<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropClassListsIdFromClassAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->dropColumn('class_lists_id');
        });
    }

    public function down()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('class_lists_id')->nullable();
        });
    }
}
