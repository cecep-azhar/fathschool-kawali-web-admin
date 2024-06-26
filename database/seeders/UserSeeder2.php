<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UserSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Developer',
            'role' => 'Admin',
            'email' => 'developer@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1997-01-31',
        ]);

        $accountant = User::create([
            'name' => 'Accountant',
            'role' => 'Accountant',
            'email' => 'accountant@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1997-02-01',
        ]);

        $teacher = User::create([
            'name' => 'Teacher',
            'role' => 'Teacher',
            'email' => 'teacher@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1995-04-22',
        ]);

        $parent = User::create([
            'name' => 'Parent',
            'role' => 'Parent',
            'email' => 'parent@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1996-01-30',
        ]);

        $student = User::create([
            'name' => 'Student',
            'role' => 'Student',
            'email' => 'student@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1996-01-25',
        ]);

        $students = User::where('role', 'Student')->get();
        foreach ($students as $student) {
            $student->profile()->create([
                'roll_no' => rand(1, 2000).Str::random(1),
                'session' => '2023-2023',
                'student_id' => idGenerate(),
                'blood_group' => Arr::random(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
                'physical_disability' => Arr::random(['Normal', 'Blind']),
                'previous_school_name' => 'Test School',
                'previous_school_year_of_exist' => '2010',
                'religion' => Arr::random(['Buddhism', 'Islam', 'Christianity', 'Scientology']),
            ]);
            // parent store
            $rand = rand(1, 3);
            for ($i = 0; $i < $rand; $i++) {
                $student->parents()->sync(User::parent()->inRandomOrder()->value('id'));
            }
        }

        $teachers = User::where('role', 'Teacher')->get();
        foreach ($teachers as $teacher) {
            $teacher->profile()->create([
                'highest_degree_name' => 'Example Highest Degree',
                'institute_name' => 'Example Institute Name',
                'passing_year' => '2021',
                'religion' => Arr::random(['Buddhism', 'Islam', 'Christianity', 'Scientology']),
                'nationality' => 'Bangladeshi',
            ]);
        }
    }
}
