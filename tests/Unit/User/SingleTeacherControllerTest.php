<?php

// use App\Models\Assignment;
// use App\Models\ClassRoutine;
// use App\Models\OnlineClass;
// use App\Models\Subject;
// use App\Models\Syllabus;
// use App\Models\TeacherSubject;
// use App\Models\User;
// use App\Models\UserCourse;
// use Database\Seeders\CourseSeeder;
// use Database\Seeders\SubjectSeeder;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Inertia\Testing\AssertableInertia;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
// use Tests\TestCase;

// class SingleTeacherControllerTest extends TestCase
// {
//     use RefreshDatabase;

//     public function test_teacher_can_see_my_course_index_page()
//     {
//         // Prepare test data
//         $this->seed([CourseSeeder::class, SubjectSeeder::class]);
//         $this->rolePermission();
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);
//         User::factory(2)->create(['role' => 'student']);
//         $this->actingAs($user);
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);
//         UserCourse::created(['user_id' => 2, 'course_id' => 1]);
//         UserCourse::created(['user_id' => 3, 'course_id' => 1]);

//         // Send GET request to the "My Course" index page
//         $response = $this->get(route('my-subject'));

//         // Assert response status is 200 (OK)
//         $response->assertStatus(200);

//         // Assert Inertia page structure and data
//         $response->assertInertia(function (AssertableInertia $page) {
//             $page->component('Teacher/Subjects')
//                 ->tap(function ($page) {
//                     // Assert required data is present
//                     $page->has('subjects');
//                 });
//         });
//     }

//     public function test_teacher_can_see_my_course_subject_details_page()
//     {
//         // Prepare test data
//         $this->rolePermission();
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);
//         $this->actingAs($user);

//         $this->seed([CourseSeeder::class]);
//         $subject = Subject::create(['course_id' => 1, 'Name' => 'Math']);
//         Assignment::factory()->create(['subject_id' => 1, 'course_id' => 1]);
//         Syllabus::factory()->create();
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);
//         OnlineClass::factory()->create(['subject_id' => 1, 'course_id' => 1, 'teacher_id' => 1]);
//         UserCourse::created(['user_id' => 2, 'course_id' => 1]);

//         // Send GET request to the subject details page
//         $response = $this->get(route('subject.details', $subject->slug));

//         // Assert response status is 200 (OK)
//         $response->assertStatus(200);

//         // Assert Inertia page structure and data
//         $response->assertInertia(function (AssertableInertia $page) {
//             $page->component('Teacher/SubjectDetails')
//                 ->tap(function ($page) {
//                     // Assert required data is present
//                     $page->has('course');
//                     $page->has('assignments.data.0');
//                     $page->has('students');
//                     $page->has('online_classes.data.0');
//                     $page->has('syllabuses.data.0');
//                     $page->has('subject_teachers.0');
//                     $page->has('upcoming_assignments');
//                 });
//         });
//     }

//     public function test_teacher_can_see_my_schedule()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         $subject = Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => $subject->id]);

//         // Creating a ClassRoutine entry
//         ClassRoutine::create([
//             'course_id' => 1,
//             'teacher_id' => 1,
//             'subject_id' => 1,
//             'start_time' => '10:00',
//             'end_time' => '12:00',
//         ]);

//         // Sending a GET request to the my schedule page
//         $response = $this->get(route('my.schedule'));

//         // Asserting the response status code
//         $response->assertStatus(200);

//         // Asserting the Inertia page
//         $response->assertInertia(function (AssertableInertia $page) {
//             $page->component('Teacher/MySchedule')
//                 ->tap(function ($page) {
//                     $page->has('schedules.0');
//                     $page->has('classes.0');
//                 });
//         });
//     }

//     public function test_teacher_can_see_my_schedule_query()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         $subject = Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => $subject->id]);

//         // Creating a ClassRoutine entry
//         ClassRoutine::create([
//             'course_id' => 1,
//             'teacher_id' => 1,
//             'subject_id' => 1,
//             'start_time' => '10:00',
//             'end_time' => '12:00',
//         ]);

//         // Sending a GET request to the my schedule page with a query parameter
//         $response = $this->get('/my/schedule?course_id=1');

//         // Asserting the response status code
//         $response->assertStatus(200);

//         // Asserting the Inertia page
//         $response->assertInertia(function (AssertableInertia $page) {
//             $page->component('Teacher/MySchedule')
//                 ->tap(function ($page) {
//                     $page->has('schedules.0');
//                     $page->has('classes.0');
//                     $page->has('query.course_id');
//                 });
//         });
//     }

//     public function test_teacher_online_class_index_page()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         $subject = Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating an assignment
//         Assignment::factory()->create(['subject_id' => $subject->id, 'course_id' => 1]);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

//         // Creating an OnlineClass entry
//         OnlineClass::factory()->create(['subject_id' => 1, 'course_id' => 1, 'teacher_id' => 1]);

//         // Sending a GET request to the online class index page
//         $response = $this->get(route('online.class.index'));

//         // Asserting the response status code
//         $response->assertStatus(200);

//         // Asserting the Inertia page
//         $response->assertInertia(function (AssertableInertia $page) {
//             $page->component('Teacher/OnlineClassList');
//         });
//     }

//     public function test_teacher_can_store_online_class()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

//         // Creating data for the request
//         $data = [
//             'topic' => 'Lomeyo',
//             'start_date' => '2068-12-12T16:50:49+0600',
//             'password' => 'asd123adb',
//             'description' => 'asd',
//             'course' => 1,
//             'subject' => 1,
//             'status' => 'waiting',
//         ];

//         // Sending a POST request to store the online class
//         $response = $this->post(route('online.class.store'), $data);

//         // Asserting the response status code
//         $response->assertStatus(302);

//         // Asserting the number of OnlineClass entries
//         expect(OnlineClass::count())->toBe(1);
//     }

//     public function test_teacher_can_fail_to_store_online_class_for_validation()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

//         // Sending a POST request to store the online class with empty data
//         $response = $this->post(route('online.class.store'), [])
//             ->assertSessionHasErrors(['topic', 'start_date', 'subject', 'course', 'password']);

//         // Asserting the response status code
//         $response->assertStatus(302);

//         // Asserting the number of OnlineClass entries
//         expect(OnlineClass::count())->toBe(0);
//     }

//     public function test_teacher_can_update_online_classes_information()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

//         // Creating an OnlineClass entry
//         OnlineClass::factory()->create();

//         // Getting the first OnlineClass entry
//         $oc = OnlineClass::first();

//         // Creating data for the request
//         $data = [
//             'topic' => 'Lomeyo',
//             'start_date' => '2068-12-12T16:50:49+0600',
//             'password' => 'asd123adb',
//             'description' => 'asd',
//             'course' => 1,
//             'subject' => 1,
//             'status' => 'waiting',
//         ];

//         // Sending a POST request to update the online class
//         $response = $this->post(route('online.class.store'), $data);

//         // Asserting the response status code
//         $response->assertStatus(302);

//         // Asserting the updated topic of the OnlineClass entry
//         expect(OnlineClass::first()->topic)->toBe($oc->topic);
//     }

//     public function test_teacher_will_fail_to_update_online_classes_information_for_validation()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

//         // Creating an OnlineClass entry
//         OnlineClass::factory()->create();

//         // Creating data for the request
//         $data = [
//             'topic' => 'Lomeyo',
//             'status' => 'waiting',
//         ];

//         // Sending a PUT request to update the online class with incomplete data
//         $response = $this->put(route('online.class.update', 1), $data)
//             ->assertSessionHasErrors(['start_date', 'subject', 'course', 'password']);

//         // Asserting the response status code
//         $response->assertStatus(302);

//         // Asserting that the updated topic is not present in the database
//         $this->assertDatabaseMissing('online_classes', [
//             'topic' => 'Lomeyo',
//         ]);
//     }

//     public function test_teacher_can_delete_onlineClass()
//     {
//         // Setting up role permissions
//         $this->rolePermission();

//         // Creating a user with the 'Teacher' role
//         $user = User::factory()->create([
//             'role' => 'Teacher',
//         ]);

//         // Authenticating the user
//         $this->actingAs($user);

//         // Seeding the CourseSeeder
//         $this->seed([CourseSeeder::class]);

//         // Creating a subject
//         Subject::create(['course_id' => 1, 'Name' => 'Math']);

//         // Creating a TeacherSubject entry
//         TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

//         // Creating an OnlineClass entry
//         OnlineClass::factory()->create(['subject_id' => 1, 'course_id' => 1, 'teacher_id' => 1]);

//         // Sending a DELETE request to delete the online class
//         $response = $this->delete(route('online.class.destroy', 1));

//         // Asserting the response status code
//         $response->assertStatus(302);

//         // Asserting the number of OnlineClass entries
//         expect(OnlineClass::count())->toBe(0);
//     }

//     public function rolePermission()
//     {
//         //  Create roles
//         $roleTeacher = Role::create([
//             'name' => 'Teacher',
//             'description' => 'This is Admin Teacher',
//         ]);

//         $permissions = [
//             [
//                 'group_name' => 'subjects',
//                 'permissions' => [
//                     'subjects.show',
//                 ],
//             ],
//             [
//                 'group_name' => 'Online Class',
//                 'permissions' => [
//                     'online-class.create',
//                     'online-class.edit',
//                     'online-class.destroy',
//                 ],
//             ],
//         ];

//         for ($i = 0; $i < count($permissions); $i++) {
//             $permissionGroup = $permissions[$i]['group_name'];

//             for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
//                 // Create Permission
//                 $permission = Permission::create([
//                     'name' => $permissions[$i]['permissions'][$j],
//                     'group_name' => $permissionGroup,
//                 ]);
//             }
//         }

//         $roleTeacher->givePermissionTo([
//             'subjects.show',
//             'online-class.create',
//             'online-class.edit',
//             'online-class.destroy',
//         ]);
//     }
// }
