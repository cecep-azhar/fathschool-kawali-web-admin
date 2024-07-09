<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameClassListsIdToCourseIdInClassAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->renameColumn('class_lists_id', 'course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_attendances', function (Blueprint $table) {
            $table->renameColumn('course_id', 'class_lists_id');
        });
    }
}
