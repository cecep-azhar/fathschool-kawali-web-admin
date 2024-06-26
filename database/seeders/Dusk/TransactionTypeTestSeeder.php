<?php

namespace Database\Seeders\Dusk;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expense_types = ['Rent', 'Parking fees'];

        foreach ($expense_types as $key => $value) {

            TransactionType::create([
                'type' => 'expense',
                'name' => $value,
            ]);
        }
    }
}
