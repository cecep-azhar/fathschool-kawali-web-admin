<?php

namespace Database\Seeders\Dusk;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory(10)->create();
    }
}
