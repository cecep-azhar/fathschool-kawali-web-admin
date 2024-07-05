<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learning_lessons', function (Blueprint $table) {
            $table->renameColumn('lessons_id', 'subjects_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learning_lessons', function (Blueprint $table) {
            $table->renameColumn('subjects_id', 'lessons_id');
        });
    }
};
