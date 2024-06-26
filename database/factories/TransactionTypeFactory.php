<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionType>
 */
class TransactionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $expense_types = ['Rent', 'Mortgage payment', 'Utilities (electricity, water, gas)', 'Groceries', 'Dining out', 'Transportation (fuel, public transportation fares)', 'Insurance (car, home, health)', 'Cell phone bill', 'Internet bill', 'Cable or satellite TV bill', 'Streaming services (Netflix, Hulu, etc.)', 'Gym membership', 'Subscriptions (magazines, newspapers)', 'Clothing and shoes', 'Personal care products (shampoo, soap, etc.)', 'Medical expenses (doctor visits, prescriptions)', 'Dental expenses', 'Vision expenses (eye exams, glasses, contact lenses)', 'Childcare expenses', 'Education expenses (tuition, books)', 'Books and magazines', 'Home maintenance and repairs', 'Car maintenance and repairs', 'Car insurance', 'Parking fees', 'Homeowners or renters insurance', 'Life insurance', 'Pet expenses (food, veterinary care)', 'Gifts', 'Charity donations', 'Entertainment (movies, concerts, events)', 'Hobbies (craft supplies, equipment)', 'Vacation expenses', 'Hotel or accommodation expenses', 'Airfare or transportation for travel', 'Rental car expenses', 'Pet care services (grooming, boarding)', 'Home decor and furnishings', 'Electronics and gadgets', 'Home office expenses', 'Office supplies', 'Professional development or courses', 'Bank fees', 'Credit card fees', 'Legal fees', 'Accounting or tax services'];

        $income_types = ['Salary from primary job', 'Hourly wages', 'Tips or gratuities', 'Commission earnings', 'Bonus payments', 'Overtime pay', 'Rental income', 'Dividend income', 'Interest income', 'Capital gains from investments', 'Freelance or self-employment income', 'Royalties from intellectual property', 'Pension payments', 'Social Security benefits', 'Disability benefits', 'Child support payments', 'Alimony payments', 'Inheritance or estate distribution', 'Sale of assets', 'Grants or scholarships'];

        // Get unique items from the array
        $expense_unique_items = array_unique($expense_types);
        $income_unique_items = array_unique($income_types);
        $type = Arr::random(['expense', 'income']);

        return [
            'type' => $type,
            'name' => Arr::random($type == 'expense' ? $expense_unique_items : $income_unique_items),
        ];
    }
}
