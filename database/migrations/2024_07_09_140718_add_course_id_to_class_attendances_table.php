<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseIdToClassAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->dropColumn('course_id');
        });
    }
}
