<?php

use Database\Seeders\ChangeSettingTableDataSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->ChangeSettingTableDataSeeder();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    public function ChangeSettingTableDataSeeder()
    {
        Artisan::call('db:seed', [
            '--class' => ChangeSettingTableDataSeeder::class,
        ]);
    }
};
