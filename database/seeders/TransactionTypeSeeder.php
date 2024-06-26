<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expense_types = ['Rent', 'Mortgage payment', 'Utilities (electricity, water, gas)', 'Groceries', 'Dining out', 'Transportation (fuel, public transportation fares)', 'Insurance (car, home, health)', 'Cell phone bill', 'Internet bill', 'Cable or satellite TV bill', 'Streaming services (Netflix, Hulu, etc.)', 'Gym membership', 'Subscriptions (magazines, newspapers)', 'Clothing and shoes', 'Personal care products (shampoo, soap, etc.)', 'Medical expenses (doctor visits, prescriptions)', 'Dental expenses', 'Vision expenses (eye exams, glasses, contact lenses)', 'Childcare expenses', 'Education expenses (tuition, books)', 'Books and magazines', 'Home maintenance and repairs', 'Car maintenance and repairs', 'Car insurance', 'Parking fees', 'School expenses'];

        foreach ($expense_types as $key => $value) {

            TransactionType::create([
                'type' => 'expense',
                'name' => $value,
            ]);
        }

        $income_types = ['Salary from primary job', 'Hourly wages', 'Tips or gratuities', 'Commission earnings', 'Bonus payments', 'Overtime pay', 'Rental income', 'Dividend income', 'Interest income', 'Capital gains from investments', 'Freelance or self-employment income', 'Royalties from intellectual property', 'Pension payments', 'Social Security benefits', 'Disability benefits', 'Child support payments', 'Alimony payments', 'Inheritance or estate distribution', 'Sale of assets', 'Grants or scholarships', 'School income'];

        foreach ($income_types as $key => $value) {

            TransactionType::create([
                'type' => 'income',
                'name' => $value,
            ]);
        }
    }
}
