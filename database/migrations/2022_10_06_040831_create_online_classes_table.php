<?php

use App\Models\Subject;
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
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->text('class_id')->comment('zoom meeting has an id');
            $table->text('class_uuid')->comment('zoom meeting has an uuid');
            $table->text('host_id')->comment('zoom meeting has host_id');
            $table->string('host_email')->comment('zoom meeting has host_email');
            $table->string('topic');
            $table->longText('description')->nullable()->comment('zoom meeting call agenda');
            $table->integer('type');
            $table->enum('status', ['waiting', 'upcoming', 'completed'])->default('waiting');
            $table->dateTime('start_time');
            // $table->bigInteger('duration')->nullable()->comment("The meeting's scheduled duration, in minutes. This field is only used for scheduled zoom meetings (2).");
            $table->string('timezone')->nullable();
            $table->longText('start_url');
            $table->longText('join_url');
            $table->string('password')->nullable();
            $table->string('encrypted_password')->nullable();
            $table->foreignIdFor(Subject::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('casCade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('online_classes');
    }
};
