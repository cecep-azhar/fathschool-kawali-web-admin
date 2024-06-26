<?php

namespace Database\Seeders;

use App\Models\AdmissionFormField;
use Illuminate\Database\Seeder;

class AdmissionFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = [
            [
                'name' => 'name',
                'status' => true,
                'order' => 1,
            ],
            [
                'name' => 'email',
                'status' => true,
                'order' => 2,
            ],
            [
                'name' => 'profile_photo',
                'status' => true,
                'order' => 3,
            ],
            [
                'name' => 'date_of_birth',
                'status' => true,
                'order' => 4,
            ],
            [
                'name' => 'gender',
                'status' => true,
                'order' => 5,
            ],
            [
                'name' => 'course',
                'status' => true,
                'order' => 6,
            ],
            [
                'name' => 'phone',
                'status' => true,
                'order' => 7,
            ],
            [
                'name' => 'address',
                'status' => true,
                'order' => 8,
            ],
            [
                'name' => 'documents',
                'status' => true,
                'order' => 9,
            ],
            [
                'name' => 'national_identification_number',
                'status' => true,
                'order' => 10,
            ],
            [
                'name' => 'blood_group',
                'status' => true,
                'order' => 11,
            ],
            [
                'name' => 'physical_disability',
                'status' => true,
                'order' => 12,
            ],
            [
                'name' => 'previous_school_name',
                'status' => true,
                'order' => 13,
            ],
            [
                'name' => 'previous_school_year_of_exist',
                'status' => true,
                'order' => 14,
            ],
            [
                'name' => 'religion',
                'status' => true,
                'order' => 15,
            ],
            [
                'name' => 'bank_name',
                'status' => true,
                'order' => 16,
            ],
            [
                'name' => 'bank_account_number',
                'status' => true,
                'order' => 17,
            ],
            [
                'name' => 'note',
                'status' => true,
                'order' => 18,
            ],
            [
                'name' => 'guardian_name',
                'status' => true,
                'order' => 19,
            ],
            [
                'name' => 'guardian_email',
                'status' => true,
                'order' => 20,
            ],
            [
                'name' => 'guardian_photo',
                'status' => true,
                'order' => 21,
            ],
        ];

        foreach ($fields as $key => $field) {
            AdmissionFormField::create([
                'name' => $field['name'],
                'status' => $field['status'],
                'order' => $field['order'],
            ]);
        }
    }
}
