<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create roles
        $roleSuperAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin Admin',
        ]);
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin Teacher',
        ]);
        $roleParent = Role::create([
            'name' => 'Parent',
            'description' => 'This is Admin Parent',
        ]);
        $roleStudent = Role::create([
            'name' => 'Student',
            'description' => 'This is Admin Student',
        ]);
        $roleAccountant = Role::create([
            'name' => 'Accountant',
            'description' => 'This is Admin Accountant',
        ]);

        //  permission List as array
        $permissions = [
            [
                'group_name' => 'roles',
                'permissions' => [
                    'roles.index',
                    'roles.create',
                    'roles.show',
                    'roles.edit',
                    'roles.destroy',
                ],
            ],
            [
                'group_name' => 'sms',
                'permissions' => [
                    'sms',
                ],
            ],
            [
                'group_name' => 'holiday',
                'permissions' => [
                    'holiday.index',
                    'holiday.create',
                    'holiday.show',
                    'holiday.edit',
                    'holiday.destroy',
                ],
            ],
            [
                'group_name' => 'users',
                'permissions' => [
                    'users.index',
                    'users.create',
                    'users.show',
                    'users.edit',
                    'users.destroy',
                    'student.promotion',
                    'admission.form',
                    'teacher.list',
                    'student.list',
                ],
            ],
            [
                'group_name' => 'Academic Management',
                'permissions' => [
                    'academic.management',
                    'group.chat',
                ],
            ],
            [
                'group_name' => 'Course',
                'permissions' => [
                    'course.index',
                    'course.create',
                    'course.edit',
                    'course.destroy',
                ],
            ],
            [
                'group_name' => 'subjects',
                'permissions' => [
                    'subjects.index',
                    'subjects.create',
                    'subjects.show',
                    'subjects.edit',
                    'subjects.destroy',
                ],
            ],
            [
                'group_name' => 'event',
                'permissions' => [
                    'event.index',
                    'event.create',
                    'event.edit',
                    'event.destroy',
                ],
            ],
            [
                'group_name' => 'request-leave',
                'permissions' => [
                    'request-leave.index',
                    'request-leave.create',
                    'request-leave.edit',
                    'request-leave.destroy',
                    'manage.leave-type',
                ],
            ],
            [
                'group_name' => 'Online Class',
                'permissions' => [
                    'online-class.index',
                    'online-class.create',
                    'online-class.edit',
                    'online-class.destroy',
                ],
            ],
            [
                'group_name' => 'Exam Result',
                'permissions' => [
                    'exam-result.index',
                    'exam-result.create',
                    'exam-result.edit',
                    'exam-result.destroy',
                ],
            ],
            [
                'group_name' => 'admission',
                'permissions' => [
                    'admission.index',
                    'admission.create',
                    'admission.edit',
                    'admission.show',
                    'admission.destroy',
                    'bulk.admission',
                ],
            ],
            [
                'group_name' => 'meeting',
                'permissions' => [
                    'meeting.index',
                    'meeting.create',
                    'meeting.edit',
                    'meeting.destroy',
                ],
            ],
            [
                'group_name' => 'Notice Board',
                'permissions' => [
                    'notice-board.index',
                    'notice-board.create',
                    'notice-board.show',
                    'notice-board.edit',
                    'notice-board.destroy',
                ],
            ],
            [
                'group_name' => 'class Schedule',
                'permissions' => [
                    'course-schedule.index',
                    'course-schedule.create',
                    'course-schedule.edit',
                    'course-schedule.destroy',
                ],
            ],
            [
                'group_name' => 'Website Settings',
                'permissions' => [
                    'settings',
                    'currency',
                    'language',
                ],
            ],
            [
                'group_name' => 'Reports',
                'permissions' => [
                    'report.index',
                    'report.transaction',
                    'report.attendance',
                    'report.other'
                ],
            ],

            [
                'group_name' => 'assignment',
                'permissions' => [
                    'assignment.index',
                    'assignment.create',
                    'assignment.show',
                    'assignment.edit',
                    'assignment.destroy',
                ],
            ],
            [
                'group_name' => 'attendance',
                'permissions' => [
                    'attendance.index',
                    'attendance.create',
                    'attendance.edit',
                    'attendance.destroy',
                ],
            ],
            [
                'group_name' => 'syllabus',
                'permissions' => [
                    'syllabus.index',
                    'syllabus.create',
                    'syllabus.edit',
                    'syllabus.destroy',
                ],
            ],

            [
                'group_name' => 'transaction-type',
                'permissions' => [
                    'transaction-type.index',
                    'transaction-type.create',
                    'transaction-type.edit',
                    'transaction-type.destroy',
                ],
            ],
            [
                'group_name' => 'transaction',
                'permissions' => [
                    'transaction.index',
                    'transaction.create',
                    'transaction.show',
                    'transaction.edit',
                    'transaction.destroy',
                ],
            ],
            [
                'group_name' => 'invoice',
                'permissions' => [
                    'invoice.index',
                    'invoice.create',
                    'invoice.show',
                    'invoice.edit',
                    'invoice.destroy',
                    'invoice.print',
                ],
            ],
            [
                'group_name' => 'plan',
                'permissions' => [
                    'plan.index',
                    'plan.create',
                    'plan.edit',
                    'plan.destroy',
                ],
            ],

            [
                'group_name' => 'Schedule',
                'permissions' => [
                    'schedule.index',
                    'schedule.create',
                    'schedule.edit',
                    'schedule.destroy',
                ],
            ],
            [
                'group_name' => 'others',
                'permissions' => [
                    'admin.dashboard',
                    'teacher.dashboard',
                    'accountant.dashboard',
                    'parent.dashboard',
                    'student.dashboard',
                ],
            ],
        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);
            }
        }

        $roleSuperAdmin->givePermissionTo([
            'admin.dashboard',
            'academic.management',

            'meeting.index',
            'meeting.create',
            'meeting.edit',
            'meeting.destroy',

            'roles.index',
            'roles.create',
            'roles.show',
            'roles.edit',
            'roles.destroy',

            'event.index',
            'event.create',
            'event.edit',
            'event.destroy',

            'transaction.index',
            'transaction.create',
            'transaction.show',
            'transaction.edit',
            'transaction.destroy',

            'transaction-type.index',
            'transaction-type.create',
            'transaction-type.edit',
            'transaction-type.destroy',

            'plan.index',
            'plan.create',
            'plan.edit',
            'plan.destroy',

            'event.index',
            'event.create',
            'event.edit',
            'event.destroy',

            'notice-board.index',
            'notice-board.create',
            'notice-board.show',
            'notice-board.edit',
            'notice-board.destroy',

            'request-leave.index',
            'request-leave.create',
            'request-leave.edit',
            'request-leave.destroy',
            'manage.leave-type',

            'users.index',
            'users.create',
            'users.show',
            'users.edit',
            'users.destroy',
            'student.promotion',
            'admission.form',
            'teacher.list',
            'student.list',

            'holiday.index',
            'holiday.create',
            'holiday.show',
            'holiday.edit',
            'holiday.destroy',

            'report.index',
            'report.transaction',
            'report.attendance',
            'report.other',

            'settings',
            'currency',
            'language',
            'sms',

            'admission.index',
            'admission.create',
            'admission.edit',
            'admission.show',
            'admission.destroy',
            'bulk.admission',
            'report.other',
        ]);

        $roleAccountant->givePermissionTo([
            'accountant.dashboard',

            'transaction-type.index',
            'transaction-type.create',
            'transaction-type.edit',
            'transaction-type.destroy',

            'transaction.index',
            'transaction.create',
            'transaction.show',
            'transaction.edit',
            'transaction.destroy',

            'transaction-type.index',
            'transaction-type.create',
            'transaction-type.edit',
            'transaction-type.destroy',

            'invoice.index',
            'invoice.create',
            'invoice.show',
            'invoice.edit',
            'invoice.destroy',
            'invoice.print',

            'plan.index',
            'plan.create',
            'plan.edit',
            'plan.destroy',
            'meeting.index',
            'meeting.create',
            'meeting.edit',
            'meeting.destroy',

            'request-leave.index',
            'request-leave.create',
            'event.index',
            'event.create',
            'event.edit',
            'event.destroy',
            'notice-board.index',
            'report.index',
            'report.transaction',
            'report.other',

            'holiday.index',
            'holiday.create',
            'holiday.show',
            'holiday.edit',
            'holiday.destroy',
        ]);

        $roleTeacher->givePermissionTo([
            'teacher.dashboard',
            'group.chat',
            'notice-board.index',
            'notice-board.index',
            'event.index',
            'event.create',
            'event.edit',
            'event.destroy',
            'subjects.show',

            'online-class.index',
            'online-class.create',
            'online-class.edit',
            'online-class.destroy',

            'assignment.index',
            'assignment.create',
            'assignment.show',
            'assignment.edit',
            'assignment.destroy',

            'attendance.index',
            'attendance.create',
            'attendance.edit',
            'attendance.destroy',

            'exam-result.index',
            'exam-result.create',
            'exam-result.edit',
            'exam-result.destroy',

            'syllabus.index',
            'syllabus.create',
            'syllabus.edit',
            'syllabus.destroy',

            'meeting.index',
            'meeting.create',
            'meeting.edit',
            'meeting.destroy',

            'holiday.index',
            'holiday.create',
            'holiday.show',
            'holiday.edit',
            'holiday.destroy',

            'request-leave.index',
            'request-leave.create',
            'report.index',
            'report.attendance',
            'users.show',

            'report.other',
        ]);

        $roleParent->givePermissionTo([
            'parent.dashboard',
            'transaction.index',
            'assignment.index',
            'assignment.show',
            'attendance.index',
            'course-schedule.index',
            'exam-result.index',
            'transaction.show',
        ]);

        $roleStudent->givePermissionTo([
            'student.dashboard',
            'transaction.index',
            'attendance.index',
            'exam-result.index',
            'group.chat',
            'notice-board.index',
            'holiday.index',
            'event.index',
            'assignment.show',
            'subjects.show',
            'transaction.show',
            'request-leave.index',
            'request-leave.create',
        ]);
    }
}
