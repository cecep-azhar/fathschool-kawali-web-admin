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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->enum('app_logo_type', ['image', 'text'])->default('image');
            $table->string('text_logo_name')->nullable();
            $table->string('app_name')->nullable();
            $table->string('school_code')->nullable();
            $table->string('dark_logo')->nullable();
            $table->string('light_logo')->nullable();
            $table->string('favicon_icon')->nullable();
            $table->longText('app_description')->nullable();
            $table->string('principal_name')->nullable();
            $table->string('app_address')->nullable();
            $table->string('app_email')->nullable();
            $table->string('app_phone')->nullable();
            $table->string('app_currency')->default('USD');
            $table->text('key_to_grades');
            $table->text('grade_summary');
            $table->unsignedInteger('over_due_days')->default(0);
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
        Schema::dropIfExists('settings');
    }
};
