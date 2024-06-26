<?php

namespace App\Http\Controllers\Sms;

use App\Events\SendSMS;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\SmsTemplate;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SmsController extends Controller
{
    public function index(Request $request)
    {
        // Check if the authenticated user has permission to access the SMS functionality
        abort_if(! userCan('sms'), 403);

        // Define the types of SMS and their respective IDs
        $types = [
            [
                'id' => 1,
                'type' => 'All',
            ],
            [
                'id' => 2,
                'type' => 'Specific Role',
            ],
            [
                'id' => 3,
                'type' => 'Individual',
            ],
            [
                'id' => 4,
                'type' => 'Course',
            ],
        ];

        // Get all available roles and courses
        $roles = Role::all();
        $courses = Course::get(['id', 'name']);

        // Get all available SMS templates
        $templates = SmsTemplate::get(['id', 'title', 'message']);

        // Initialize an empty array to store user data based on the selected criteria
        $users = [];

        // Determine the users to display based on the selected criteria
        if ($request->individualRole_id == 'Student') {
            // Get users who have a non-null 'student_id' field
            $users = UserProfile::whereNotNull('student_id')->get();
        } else {
            // Get users with the specified role ID
            $users = User::where('role', $request->individualRole_id)->get();
        }

        // Store the user input data as filter_data for re-populating the form in the view
        $filter_data = $request;

        // Return the 'Admin/Sms/Index' view with the necessary data for rendering the page
        return inertia('Admin/Sms/Index', compact('types', 'roles', 'courses', 'users', 'templates', 'filter_data'));
    }

    public function send(Request $request)
    {
        // Check if the authenticated user has permission to send SMS
        abort_if(! userCan('sms'), 403);

        // Prepare the data for sending the SMS
        $data['message'] = $request->message;

        // Determine the list of phone numbers based on the selected criteria
        switch ($request->type_id) {
            case 1:
                // Get all users with a non-null 'phone' field
                $data['info'] = User::whereNotNull('phone')->get(['phone', 'name', 'email']);
                break;

            case 2:
                if ($request->has('role_id') && $request->role_id != null) {
                    // Get users with the specified role ID and a non-null 'phone' field
                    $data['info'] = User::whereRole($request->role_id)->whereNotNull('phone')->get(['phone', 'name', 'email']);
                } else {
                    // Display a warning message if the role is not selected
                    $this->flashWarning('Role not selected');

                    return back();
                }
                break;

            case 3:
                if ($request->has('individualRole_id') && $request->has('user_id') && $request->user_id != null) {
                    // Get the user with the specified ID and a non-null 'phone' field
                    $data['info'] = User::where('id', $request->user_id)->whereNotNull('phone')->get(['phone', 'name', 'email']);
                } else {
                    // Display a warning message if the role or user is not selected
                    $this->flashWarning('Role or user not selected');

                    return back();
                }
                break;

            case 4:
                if ($request->has('course_id') && $request->course_id != null) {
                    // Get the IDs of users associated with the specified course
                    $userId = UserCourse::where('course_id', $request->course_id)->pluck('user_id')->toArray();
                    // Get users with the IDs and a non-null 'phone' field
                    $data['info'] = User::whereIn('id', $userId)->whereNotNull('phone')->get(['phone','name','email']);
                } else {
                    // Display a warning message if the course is not selected
                    $this->flashWarning('Please select a course');

                    return back();
                }
                break;

            default:
                // Display a warning message for an invalid type_id
                $this->flashWarning('Invalid type_id');

                return back();
        }

        // Trigger the 'SendSMS' event to send the SMS
        event(new SendSMS($data));

        // Display a success message after the SMS is sent
        $this->flashSuccess('Message Sent');

        return back();
    }
}
