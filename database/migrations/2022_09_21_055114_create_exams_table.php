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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('grade');
            $table->decimal('gpa', 9, 2);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('course_id');
            $table->timestampTz('start_date')->nullable();
            $table->timestampTz('end_date')->nullable();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('casCade');
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
        Schema::dropIfExists('exams');
    }
};
