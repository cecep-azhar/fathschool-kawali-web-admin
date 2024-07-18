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
        Schema::create('landing_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_link');
            $table->string('title');
            $table->text('description');
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
        // Schema::table('gallery_sliders', function (Blueprint $table) {
        //     $table->dropColumn('title');
        //     $table->dropColumn('description');
        //     $table->dropColumn('youtube_link');
        // });
        Schema::dropIfExists('landing_videos');
    }
};
