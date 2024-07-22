<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidToClassAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
        });
    }

    public function down()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
