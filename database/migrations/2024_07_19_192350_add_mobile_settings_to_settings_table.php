<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileSettingsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->enum('production_status', ['Alpha', 'Beta', 'Production', 'Maintenance'])
                  ->default('Alpha')
                  ->after('app_description'); // Adjust the position as needed
            $table->string('mobile_version')->nullable()->after('production_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('production_status');
            $table->dropColumn('mobile_version');
        });
    }
}
