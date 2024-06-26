<?php

use App\Models\AdmissionRequest;
use App\Models\Notice;
use App\Models\User;
use Database\Seeders\AdmissionFormSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\GallerySliderSeeder;
use Database\Seeders\NoticeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class FrontendControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page()
    {
        // Insert test data to the database
        $this->seed(GallerySliderSeeder::class);

        // Check if the URL returns a successful response
        $response = $this->get('/');
        $response->assertStatus(200);

        // Check if the expected view components are rendered using Inertia.js
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Frontend/Welcome')
                ->tap(function ($page) {
                    $page->has('sliders.0'); // Assert that the 'sliders' data contains at least one item
                });
        });
    }

    public function test_admission_page()
    {
        // Insert test data to the database
        $this->seed(AdmissionFormSeeder::class);
        $this->seed(CourseSeeder::class);

        // Check if the URL returns a successful response
        $response = $this->get('/admission');
        $response->assertStatus(200);

        // Check if the expected view components are rendered using Inertia.js
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Frontend/Admission')
                ->tap(function ($page) {
                    $page->has('courses.0'); // Assert that the 'courses' data contains at least one item
                    $page->has('fields.0'); // Assert that the 'fields' data contains at least one item
                });
        });
    }

    public function test_admission_request_store()
    {
        // Insert test data to the database
        $this->seed(CourseSeeder::class);
        User::factory()->create([
            'role' => 'Admin',
            'email' => 'shahaapo@gmail.com',
        ]);

        Notification::fake();

        $data = [
            'name' => 'KID',
            'email' => 'lomeyo@gmail.com',
            'classes' => 1,
            'parent_name' => 'Lomeyo',
            'parent_email' => 'lomeyo12@gmail.com',
            'date_of_birth' => '2023-06-01',
            'gender' => 'male',
        ];
        $response = $this->post(route('admission.store'), $data);
        $response->assertStatus(302);
        expect(AdmissionRequest::count())->toBe(1);
    }

    public function test_frontend_announcement_page()
    {
        // Insert test data to the database
        User::factory()->create(['role' => 'Admin']);
        $this->seed(NoticeSeeder::class);

        // Check if the URL returns a successful response
        $response = $this->get('/announcement');
        $response->assertStatus(200);

        // Check if the expected view components are rendered using Inertia.js
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Frontend/Announcement')
                ->tap(function ($page) {
                    $page->has('notices.0'); // Assert that the 'notices' data contains at least one item
                });
        });
    }

    public function test_frontend_announcement_details_page()
    {
        // Insert test data to the database
        User::factory()->create(['role' => 'Admin']);
        Notice::factory()->create(['title' => 'Bangladesh', 'status' => 'public']);

        // Check if the URL returns a successful response
        $notice = Notice::first();
        $response = $this->get(route('announcement.details', $notice->slug));
        $response->assertStatus(200);

        // Check if the expected view components are rendered using Inertia.js
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Frontend/AnnouncementDetails')
                ->tap(function ($page) {
                    $page->has('notice'); // Assert that the 'notice' has data
                });
        });
    }
}
