<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Department;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // for email validation
            $query = User::query();
            $email = $row['email'];
            $new_email = '';
            if ($email) {

                $check_email_is_exist = $query->where('email', $email)->first();
                if ($check_email_is_exist) {
                    $new_email = Str::random(4) . $email;
                } else {
                    $new_email = $email;
                }
            }


            // for department validation
            // $department = '';
            // if ($row['departmentname']) {

            //     $exit_department = Department::where('name', $row['departmentname'])->first();
            //     if ($exit_department) {
            //         $department = $exit_department->id;
            //     } else {
            //         $department = Department::inRandomOrder()->value('id');
            //     }
            // } else {
            //     $department = Department::inRandomOrder()->value('id');
            // }

            $added_user = User::create([
                'nik' => isset($row['nik']) ? $row['nik'] : null,
                'name' => isset($row['name']) ? $row['name'] : Str::random(6),
                // 'gender' => isset($row['gender']) ? $row['gender'] : Arr::random(['male', 'female', 'other']),
                'date_of_birth' => isset($row['tanggal_lahir']) ? Carbon::parse($row['tanggal_lahir']) : Carbon::now(),
                'email' => isset($new_email) ? $new_email : null,
                'role' => 'Teacher',
                'password' => isset($row['password']) ? bcrypt($row['password']) : bcrypt('password'),
                'phone' => isset($row['nomor_telepon']) ? $row['nomor_telepon'] : Str::random(6),
                // 'address' => isset($row['address']) ? $row['address'] : Str::random(6),
                // 'department_id' => $department,
            ]);

            $added_user;

            // $profile = $added_user->profile()->create([
            //     'roll_no' => isset($new_roll_no) ? $new_roll_no : Str::random(6),
            //     'student_id' => idGenerate(),
            // ]);

            // $course = $added_user->courses()->create([
            //     'course_id' => $class,
            // ]);
        }
    }
}
