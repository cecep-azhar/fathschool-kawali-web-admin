<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Currency;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'title' => 'Basic',
                'description' => 'This is the basic plan',
                'price' => '20',
                'benefits' => [
                    'Teacher Training',
                    'Peers Accommodations',
                    'Assistant',
                ],
            ],
            [
                'title' => 'Standard',
                'description' => 'This is the standard plan',
                'price' => '50',
                'benefits' => [
                    'Teacher Training',
                    'Peers Accommodations',
                    'Assistant',
                    'Learning Materials',
                ],
            ],
            [
                'title' => 'Premium',
                'description' => 'This is the premium plan',
                'price' => '100',
                'benefits' => [
                    'Connecting with individual learning styles',
                    'Individual Education Plans',
                    'Teacher Training',
                    'Peers Accommodations',
                    'Assistant',
                    'Technology Barents',
                    'Learning Materials',
                ],
            ],
            [
                'title' => 'VIP',
                'description' => 'This is the VIP plan',
                'price' => '150',
                'benefits' => [
                    'Individual Education Plans',
                    'Teacher Training',
                    'Peers Accommodations',
                    'Assistant',
                    'Technology Barents',
                    'Learning Materials',
                    'Free Lunch',
                ],
            ],
            [
                'title' => 'Normal',
                'description' => 'This is the normal plan',
                'price' => '10',
                'benefits' => [
                    'Peers Accommodations',
                    'Assistant',
                ],
            ],
        ];

        collect($plans)->each(function ($plan) {
            $created_plan = Plan::create([
                'title' => $plan['title'],
                'description' => $plan['description'],
                'price' => $plan['price'],
                'course_id' => Course::inRandomOrder()->value('id'),
                'currency' => Currency::inRandomOrder()->value('code'),
            ]);
            $amount = rand(10, 500);
            foreach ($plan['benefits'] as $key => $benefit) {
                $created_plan->benefits()->create([
                    'title' => $benefit,
                    'amount' => $amount,
                ]);
            }
        });
    }
}
