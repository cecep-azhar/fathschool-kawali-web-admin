<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OnlineClass>
 */
class OnlineClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $titles = ['Introduction to Psychology', "Beginner's Guide to Digital Photography", 'Financial Literacy 101', 'Web Development Fundamentals', 'Basics of Graphic Design', 'Introduction to Programming with Python', 'Effective Communication Skills', 'Social Media Marketing Strategies', 'Introduction to Data Science', 'Creative Writing Workshop', 'Introduction to Philosophy', 'Business Management Essentials', "Beginner's Guide to Investing", 'Introduction to Human Anatomy', 'Spanish Language for Beginners', 'Introduction to Artificial Intelligence', 'Principles of Marketing', 'Introduction to Nutrition and Healthy Eating', 'Web Design for Beginners', 'Introduction to Project Management', 'Digital Marketing Fundamentals', 'Introduction to Environmental Science', 'Personal Finance and Budgeting', 'Introduction to Public Speaking', 'Introduction to Sociology', 'Introduction to User Experience (UX) Design', 'Fundamentals of Accounting', 'Introduction to World History', 'Introduction to Film Studies', 'Fundamentals of Entrepreneurship', 'Introduction to Computer Science', 'Introduction to Philosophy of Mind', "Beginner's Guide to Interior Design", 'Introduction to Microbiology', 'Introduction to Social Psychology', 'Basics of Music Theory', 'Introduction to Cybersecurity', "Beginner's Guide to Drawing", 'Introduction to Astrophysics', 'Introduction to Political Science', 'Introduction to Art History', 'Introduction to Web Analytics', "Beginner's Guide to Guitar Playing", 'Introduction to Organic Chemistry', 'Introduction to Cultural Anthropology', 'Fundamentals of Economics', 'Introduction to Astronomy', 'Introduction to Criminal Justice', 'Introduction to Public Relations', "Beginner's Guide to Meditation and Mindfulness", 'Introduction to Human Resource Management', 'Introduction to Linguistics', 'Introduction to Educational Psychology', 'Basics of Fashion Design', 'Introduction to Geology', 'Introduction to International Relations', "Beginner's Guide to Yoga and Meditation", 'Introduction to Statistics', 'Introduction to Art Therapy', 'Introduction to Cognitive Psychology', 'Basics of Landscape Photography', 'Introduction to Philosophy of Science', 'Introduction to Developmental Psychology', "Beginner's Guide to Cooking", 'Introduction to Music Production', 'Introduction to Physical Chemistry', 'Basics of 3D Modeling and Animation', 'Introduction to Cultural Studies', 'Introduction to Macroeconomics', "Beginner's Guide to Knitting and Crocheting", 'Introduction to Environmental Ethics', 'Introduction to Social Work', 'Introduction to Archaeology', 'Basics of Mobile App Development', 'Introduction to American Literature', 'Introduction to Clinical Psychology', "Beginner's Guide to Oil Painting", 'Introduction to Neuroscience', 'Introduction to International Business', 'Basics of Fashion Styling', 'Introduction to Evolutionary Biology', 'Introduction to Social Media Management', "Beginner's Guide to Baking", 'Introduction to Film Production', 'Introduction to Physical Education', 'Introduction to Theatre Arts', 'Basics of Animation and Motion Graphics', 'Introduction to Gender Studies', 'Introduction to Finance', "Beginner's Guide to Floral Arrangement", 'Introduction to Environmental Science', 'Introduction to Human Rights', 'Basics of Web Content Writing', 'Introduction to Zoology', 'Introduction to Peace and Conflict Studies', "Beginner's Guide to Woodworking", 'Introduction to Organizational Behavior', 'Introduction to Cross-Cultural Communication', 'Basics of Product Design', 'Introduction to Paleontology'];

        $teacher = User::inRandomOrder()->teacher();

        $start_time = Arr::random([Carbon::today()->subDays(rand(1, 9)), Carbon::today()->addDay(rand(1, 9))]);

        // Determine the status based on the start time
        $status = 'waiting'; // Default status

        if ($start_time < Carbon::now()) {
            $status = 'completed'; // Class has already started
        } else {
            $status = 'upcoming'; // Class is upcoming
        }

        return [
            'class_id' => '83293741169',
            'class_uuid' => 'Kjeter8XSa+yLbfDbKCe6g==',
            'host_id' => '6lvv0yGfToaMRUKr42Tm0w',
            'host_email' => $teacher->value('email'),
            'topic' => Arr::random($titles),
            'description' => $this->faker->text(200),
            'type' => 2,
            'status' => $status,
            'start_time' => $start_time,
            // 'duration' => '123',
            'timezone' => 'UTC',
            'start_url' => 'https://us05web.zoom.us/s/83293741169?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMSIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJhdWQiOiJjbGllbnRzbSIsInVpZCI6IjZsdnYweUdmVG9hTVJVS3I0MlRtMHciLCJpc3MiOiJ3ZWIiLCJzayI6IjUxMDAzNjcyNzIzNjI1ODAwNTAiLCJzdHkiOjEwMCwid2NkIjoidXMwNSIsImNsdCI6MCwibW51bSI6IjgzMjkzNzQxMTY5IiwiZXhwIjoxNjc0MzYzODAyLCJpYXQiOjE2NzQzNTY2MDIsImFpZCI6Ik9NejdJVkw4VG5xTmZBRHpTMWNKakEiLCJjaWQiOiIifQ.jVtCFpgNL9s_xeEsslodGhwL1dWa93neLnpizGBQQZ0',
            'join_url' => 'https://us05web.zoom.us/j/83293741169?pwd=WmM3NmdBN3creTFvUm91d1hrQ1paQT09',
            'password' => 'password',
            'encrypted_password' => 'WmM3NmdBN3creTFvUm91d1hrQ1paQT09',
            'subject_id' => Subject::inRandomOrder()->value('id'),
            'course_id' => Course::inRandomOrder()->value('id'),
            'teacher_id' => $teacher->value('id'),
        ];
    }
}
