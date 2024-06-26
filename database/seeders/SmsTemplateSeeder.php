<?php

namespace Database\Seeders;

use App\Models\SmsTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templates = [

            [
                'title' => 'Welcome to Our School',
                'message' => 'Dear {name}, Welcome to ......... We are thrilled to have you as part of our school community!'
            ],

            [
                'title' => 'Student promotion',
                'message' => 'Dear {name}, We are happily to inform you that you are promoted to next course',
            ],

            [
                'title' => 'Attendance Update',
                'message' => 'Hello {name}, This is a reminder of your child\'s attendance for ...... If there are any concerns, please contact us at ........'
            ],

            [
                'title' => 'Upcoming Event',
                'message' => 'Dear {name}, We hope to see you at our school event on ............ For more details, visit our website or contact us at ........'
            ],

            [
                'title' => 'Fee Payment Reminder',
                'message' => 'Hi {name}, Just a friendly reminder to pay the school fees of ......... by .......... If you have any questions, please email us at ....... or call at ......'
            ],


            [
                'title' => 'Exam Results',
                'message' => 'Hello {name}, The results for the recent exams are out. Please log in to your account or contact us at ........ or ......... for more information.'
            ],

            [
                'title' => 'Emergency Alert',
                'message' => 'Dear {name}, Due to unforeseen circumstances, school will be closed on ........ Please stay safe and contact us at ........ for any urgent matters.'
            ]

        ];

        // Insert the data into the sms_templates table using the model
        foreach ($templates as $templateData) {
            SmsTemplate::create($templateData);
        }
    }
}
