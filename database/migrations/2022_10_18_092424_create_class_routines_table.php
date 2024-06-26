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
        Schema::create('class_routines', function (Blueprint $table) {
            $table->id();
            $table->string('weekday')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->boolean('is_recurring')->default(true);
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('subject_id');

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('casCade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('casCade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('casCade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_routines');
    }
};
