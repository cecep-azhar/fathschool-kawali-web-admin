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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('student_id')->nullable()->unique();
            $table->string('roll_no')->nullable()->unique();
            $table->string('session')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->text('note')->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'])->nullable();
            $table->string('physical_disability')->nullable();
            $table->string('previous_school_name')->nullable();
            $table->string('previous_school_year_of_exist')->nullable();

            $table->string('national_identification_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();

            $table->text('highest_degree_name')->nullable();
            $table->text('institute_name')->nullable();
            $table->text('passing_year')->nullable();
            $table->text('religion')->nullable();
            $table->text('nationality')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('casCade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('casCade');
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
        Schema::dropIfExists('user_profiles');
    }
};
