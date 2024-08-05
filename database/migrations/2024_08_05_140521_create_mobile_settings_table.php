<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_fathschool')->nullable();
            $table->text('description_apps')->nullable();
            $table->text('features_apps')->nullable();
            $table->text('advantages_apps')->nullable();
            $table->text('conclusion_apps')->nullable();
            $table->string('fathforce_phone_number')->nullable();
            $table->string('fathforce_browser_link')->nullable();
            $table->string('fathforce_email')->nullable();
            $table->string('logo_fathforce')->nullable();
            $table->string('logo_school')->nullable();
            $table->string('google_play_link_student')->nullable();
            $table->string('google_play_link_teacher')->nullable();
            $table->string('production_version_student')->nullable();
            $table->string('production_version_teacher')->nullable();
            $table->string('app_version_student')->nullable();
            $table->string('app_version_teacher')->nullable();
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
        Schema::dropIfExists('mobile_settings');
    }
}
