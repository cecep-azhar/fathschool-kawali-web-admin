<?php

namespace Database\Seeders;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notices = [
            [
                'title' => 'Admission Notice',
                'description' => 'Hero freedom fighter Professor Dr. On the 20th anniversary of the World University of Bangladesh founded by Abdul Mannan Chowdhury and in humble respect to the brave freedom fighters, 100% admission fee waiver on the occasion of Independence month.',
                'attachment' => 'https://wub.edu.bd/assets/images/bg-title-notice-image.jpg',
            ],
            [
                'title' => 'Notice On Shab-e-barat’',
                'description' => 'The university shall remain closed on March 08 (Wednesday), 2023 on account of ‘Shab-E-Barat’. Classes and all other activities of the university shall resume on and from March 09 (Thursday) 2023.',
                'attachment' => 'https://wub.edu.bd/assets/images/bg-title-notice-image.jpg',
            ],
            [
                'title' => 'Revised Notice : Founding Day’',
                'description' => 'World University of Bangladesh (WUB) is going to celebrate its 21st Founding Day and upcoming Independence Day on March 20, 2023. The program will be attended and participated by heroic freedom fighters and Educationists.

                Features of the programs shall include rally, plantation of trees, discussion session on war of Independence, achievements of World University Bangladesh over the last twenty years, lunch, cultural program, raffle draw and distribution of award and mementoes’.

                The students and Alumni of World University of Bangladesh are hereby requested to complete the registration between March 06, 2023 to March 10, 2023 through below link.

                Registration link-https://wub.edu.bd/event_registration/index

                Your participation will be highly appreciated.',
                'attachment' => 'https://images.unsplash.com/photo-1526378787940-576a539ba69d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80',
            ],
            [
                'title' => '“roleof Energy Audit Foreconomic Development In Bangladesh” And Training Certificate Awarding Ceremony',
                'description' => 'Department of Mechatronics Engineering, World University of Bangladesh (WUB), is going to organize a seminar on “Role of Energy Audit for Economic Development in Bangladesh”and a “Training Certificate Awarding Ceremony” on February 14, 2023 (Tuesday) from 10.30 AM to 11.30 AM. Professor Dr. Abdul MannanChoudhury, honorable Vice Chancellor, World University of Bangladesh, has kindly given his consent to be present as the chief guest of this seminar. MorshedaChoudhury, honorable Treasurer,World University of Bangladesh;Professor Dr. M. Nurul Islam, honorable Pro-Vice Chancellor; World University of Bangladesh; and Dr. Shugata Ahmed, Assistant Professor, Department of Robotics and Mechatronics Engineering, University of Dhaka, will attend the seminar as the special guests. Engr. Md. HumayunKabir, Managing Director of Reliable Engineering & Solutions Limited, will contribute as the keynote speaker in the seminar. The seminar will be presided over by Prof. Dr. Md. MizanurRahman, Head of the Department of Mechatronics Engineering, World University of Bangladesh.



                Registrar

                World University of Bangladesh',
                'attachment' => 'https://images.unsplash.com/photo-1503551723145-6c040742065b-v2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
            ],
            [
                'title' => 'Freshers’ Reception & Farewell Program (spring-2023)
                ',
                'description' => "The World English Club, Department of English, World University of Bangladesh is going to organize a Farewell and Fresher's reception program. The program will be held on 8th February, 2023, Wednesday at 10:30 PM on WUB campus premises. The purpose of setting up this program is to welcome the new students enrolled in Spring-2023 and to wish a great success for departing students in their future endeavors.

                Prof. Dr. Abdul Mannan Choudhury, honorable Vice Chancellor, World University of Bangladesh will present as the Chief Guest in this program. Professor Dr. M. Nurul Islam, honorable Pro Vice Chancellor and Morsheda Choudhury, Treasurer, World University of Bangladesh will present as Special Guests.



                Registrar

                World University of Bangladesh",
                'attachment' => 'https://images.unsplash.com/photo-1512314889357-e157c22f938d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80',
            ],
            [
                'title' => "Seminar On 'ecopoetry Reading'",
                'description' => "The Department of English, World University of Bangladesh is going to organize a seminar on 'Ecopoetry Reading' at 2:30 pm on 31 January 2023, (Tuesday) at room no 302. Faisal Ahmed, Senior Lecturer, Department of English will be the keynote speaker of the program. Md. Saiful Alam, Assistant Professor and Israt Jahan, Lecturer, Department of English will also speak on the program. Sarah Tabassun, Lecturer of the Department of English will be the convener of the event.

                The main focus of the seminar is to recognize the power of ecopoetry to humanize environmental issues.



                Registrar

                World University of Bangladesh",
                'attachment' => 'https://images.unsplash.com/photo-1517429862013-5c4b666d9ef4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
            ],
            [
                'title' => 'Holiday Notice',
                'description' => 'The university shall remain closed on January 26 (Thursday), 2023 on account of ‘Saraswati Puja’. Classes and all other activities of the university shall resume on and from January 27 (Friday) 2023.',
                'attachment' => 'https://images.unsplash.com/photo-1511802684173-b35d634c5599?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80',
            ],
        ];

        foreach ($notices as $key => $notice) {
            Notice::create([
                'user_id' => User::where('role', '!=', 'Student')->inRandomOrder()->value('id'),
                'title' => $notice['title'],
                'description' => $notice['description'],
                'status' => Arr::random(['public', 'private']),
                'created_at' => Carbon::today()->subDays(rand(0, 25)),
                'updated_at' => Carbon::today()->addDay(rand(1, 9)),
                'attachment' => $notice['attachment'],
            ]);
        }
        // Notice::factory()
        //     ->count(50)
        //     ->create();
    }
}
