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

class UsersImport implements ToCollection, WithHeadingRow
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
                    $new_email = Str::random(4).$email;
                } else {
                    $new_email = $email;
                }
            }
            // for roll_no validation
            $roll_no = $row['rollnumber'];
            $new_roll_no = '';
            if ($roll_no) {

                $check_roll_no_is_exist = UserProfile::where('roll_no', $roll_no)->first();
                if ($check_roll_no_is_exist) {
                    $new_roll_no = Str::random(4).$roll_no;
                } else {
                    $new_roll_no = $roll_no;
                }
            }
            // for parent validation
            $parent = '';
            if ($row['parentemail']) {

                $user = $query->where('email', $row['parentemail'])->first();
                if ($user) {
                    $parent = $user->id;
                } else {
                    $parent = $query->parent()->inRandomOrder()->value('id');
                }
            } else {
                $parent = $query->parent()->inRandomOrder()->value('id');
            }
            // for department validation
            $department = '';
            if ($row['departmentname']) {

                $exit_department = Department::where('name', $row['departmentname'])->first();
                if ($exit_department) {
                    $department = $exit_department->id;
                } else {
                    $department = Department::inRandomOrder()->value('id');
                }
            } else {
                $department = Department::inRandomOrder()->value('id');
            }
            // for class validation
            $class = '';
            if ($row['coursename']) {

                $exit_class = Course::where('name', $row['coursename'])->first();
                if ($exit_class) {
                    $class = $exit_class->id;
                } else {
                    $class = Course::inRandomOrder()->value('id');
                }
            } else {
                $class = Course::inRandomOrder()->value('id');
            }

            $added_user = User::create([
                'name' => isset($row['name']) ? $row['name'] : Str::random(6),
                'gender' => isset($row['gender']) ? $row['gender'] : Arr::random(['male', 'female', 'other']),
                'date_of_birth' => isset($row['dateofbirth']) ? Carbon::parse($row['dateofbirth']) : Carbon::now(),
                'email' => isset($new_email) ? $new_email : null,
                'role' => 'Student',
                'password' => isset($row['password']) ? bcrypt($row['password']) : bcrypt('password'),
                'phone' => isset($row['phone']) ? $row['phone'] : Str::random(6),
                'address' => isset($row['address']) ? $row['address'] : Str::random(6),
                'department_id' => $department,
            ]);

            $added_user->parents()->attach($parent);

            $profile = $added_user->profile()->create([
                'roll_no' => isset($new_roll_no) ? $new_roll_no : Str::random(6),
                'student_id' => idGenerate(),
            ]);

            $course = $added_user->courses()->create([
                'course_id' => $class,
            ]);
        }
    }
}
