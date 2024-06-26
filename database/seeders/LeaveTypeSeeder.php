<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'role_type' => 'staff',
                'name' => 'Paid',
            ],
            [
                'role_type' => 'staff',
                'name' => 'Non Paid',
            ],
            [
                'role_type' => 'staff',
                'name' => 'Others',
            ],
            [
                'role_type' => 'student',
                'name' => 'Half Day',
            ],
            [
                'role_type' => 'student',
                'name' => 'Full Day',
            ],
        ];

        foreach ($types as $key => $value) {
            LeaveType::create([
                'role_type' => $value['role_type'],
                'name' => $value['name'],
            ]);
        }
    }
}
