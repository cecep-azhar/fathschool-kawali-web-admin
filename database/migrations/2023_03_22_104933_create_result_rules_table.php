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
        Schema::create('result_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('gpa')->default(0);
            $table->unsignedInteger('min_mark');
            $table->unsignedInteger('max_mark');
            $table->string('grade_remark');
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
        Schema::dropIfExists('result_rules');
    }
};
