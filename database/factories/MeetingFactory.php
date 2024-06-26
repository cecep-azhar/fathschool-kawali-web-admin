<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $titles = ['Project Kickoff Meeting', 'Quarterly Business Review', 'Sales Strategy Discussion', 'Team Building Workshop', 'Product Development Brainstorming Session', 'Marketing Campaign Planning Meeting', 'Budget Review Meeting', 'Performance Evaluation Meeting', 'Customer Feedback Session', 'New Employee Orientation', 'Departmental Updates Meeting', 'Problem-Solving Workshop', 'Training and Development Session', 'Town Hall Meeting', 'Strategic Planning Retreat', 'Vendor Negotiation Meeting', 'Process Improvement Meeting', 'Cross-Functional Collaboration Session', 'Risk Assessment and Mitigation Meeting', 'Sales Pipeline Review', 'Client Onboarding Meeting', 'Stakeholder Engagement Forum', 'Innovation Ideation Session', 'Employee Recognition and Awards Ceremony', 'Crisis Management Meeting', 'Product Launch Planning Meeting', 'Market Research Discussion', 'Quality Control Review', 'Partnership Collaboration Meeting', 'Project Status Update', 'Employee Town Hall', 'Compliance and Regulatory Update', 'Resource Allocation Meeting', 'Succession Planning Discussion', 'Work-Life Balance Workshop', 'Supplier Relationship Management Meeting', 'Team Performance Review', 'Data Analysis and Insights Presentation', 'Customer Service Improvement Forum', 'Employee Benefits Review', 'Diversity and Inclusion Workshop', 'IT Infrastructure Planning Meeting', 'Sales Training Session', 'Branding and Positioning Workshop', 'Community Outreach Planning Meeting', 'Conflict Resolution Session', 'Health and Safety Committee Meeting', 'New Technology Implementation Discussion', 'Employee Engagement Survey Results Presentation', 'Board of Directors Meeting'];

        $unique_title = array_unique($titles);

        $day = rand(1, 100);
        $user = User::inRandomOrder()->first();

        return [
            'meeting_id' => rand(121, 2010),
            'meeting_uuid' => rand(122, 2020),
            'host_id' => '6lvv0yGfToaMRUKr42Tm0w'.rand(12, 200),
            'host_email' => $user->email,
            'topic' => Arr::random($unique_title),
            'description' => $this->faker->word(),
            'type' => rand(1, 2),
            'meeting_type' => 'zoom_meet',
            'status' => 'waiting',
            'user_id' => $user->id,
            'start_time' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'timezone' => 'Asia/Dhaka',
            'meeting_start_url' => 'https://us05web.zoom.us/s/83596235258?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMSIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJhdWQiOiJjbGllbnRzbSIsInVpZCI6IjZsdnYweUdmVG9hTVJVS3I0MlRtMHciLCJpc3MiOiJ3ZWIiLCJzayI6IjUxMDAzNjcyNzIzNjI1ODAwNTAiLCJzdHkiOjEsIndjZCI6InVzMDUiLCJjbHQiOjAsIm1udW0iOiI4MzU5NjIzNTI1OCIsImV4cCI6MTY5MzMxNzA5NSwiaWF0IjoxNjkzMzA5ODk1LCJhaWQiOiJPTXo3SVZMOFRucU5mQUR6UzFjSmpBIiwiY2lkIjoiIn0.wuvfKKxbwzaDrR4vOTbBYILYN222wG5IegTxOY5TInc',
            'meeting_join_url' => 'https://us05web.zoom.us/j/83596235258?pwd=9oso3p8XkKGaVKwjsZdadtVWPAfcct.1',
            'password' => 'password',
            'encrypted_password' => 'V3ExZU9MVDZVenJ3THdLTWtsVURrZz09',
        ];
    }
}
