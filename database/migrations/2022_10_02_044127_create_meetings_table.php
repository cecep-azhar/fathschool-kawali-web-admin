<?php

use App\Models\User;
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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            // for zoom meeting
            $table->text('meeting_id')->comment('zoom meeting has an id');
            $table->text('meeting_uuid')->comment('zoom meeting has an uuid');
            $table->text('host_id')->comment('zoom meeting has host_id');
            $table->string('host_email')->comment('zoom meeting has host_email');
            $table->string('topic');
            $table->longText('description')->nullable()->comment('zoom meeting call agenda');
            $table->integer('type');
            $table->enum('meeting_type', ['zoom_meet', 'google_meet'])->default('zoom_meet');
            $table->string('status');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->dateTime('start_time');
            // $table->bigInteger('duration')->nullable()->comment("The meeting's scheduled duration, in minutes. This field is only used for scheduled zoom meetings (2).");
            $table->string('timezone')->nullable();
            $table->longText('meeting_start_url');
            $table->longText('meeting_join_url');
            $table->string('password')->nullable();
            $table->string('encrypted_password')->nullable();
            // for zoom meeting end
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
        Schema::dropIfExists('meetings');
    }
};
