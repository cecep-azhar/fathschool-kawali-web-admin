<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivationToClassRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_routines', function (Blueprint $table) {
            $table->boolean('activation')->default(false)->after('is_spased'); // Sesuaikan 'some_existing_column' dengan nama kolom yang ada sebelumnya
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_routines', function (Blueprint $table) {
            $table->dropColumn('activation');
        });
    }
}
