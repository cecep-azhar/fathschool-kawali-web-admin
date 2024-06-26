<?php

namespace Tests\Unit\User;

use App\Models\Onboarding;
use App\Models\User;
use Database\Seeders\OnboardingSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OnboardingTest extends TestCase
{
    use RefreshDatabase;

    public function testCheckOnboardingContentsExistInDatabase()
    {
        $this->seed(OnboardingSeeder::class);
        $this->assertDatabaseCount(Onboarding::class, 41);
    }

    public function testOnboardingContentsUpdatePageAccess()
    {
        // Setting up role permissions
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Sending a GET request to the onboarding contents update page
        $response = $this->get(route('cms.index'));

        // Asserting the response status code
        $response->assertStatus(200);
    }

    public function testUpdateOnboardingContent()
    {
        // Setting up role permissions
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding the UserSeeder
        $this->seed(UserSeeder::class);

        // Creating the data to be sent in the request
        $data = [
            'titles' => [
                '1' => 'Notice Board',
                '2' => 'Leave Request',
            ],
            'descriptions' => [
                '1' => 'Stay up to date with the latest news, announcements, and events through the Notice Board menu.',
                '2' => 'Easily request time off and track the status of your leave requests through the Leave Request menu.',
            ],
            '_method' => 'PUT',
        ];

        // Sending a POST request to update the onboarding content
        $response = $this->post(route('cms.onboarding.update'), $data);

        // Asserting the response status code
        $response->assertStatus(302);
    }

    public function rolePermission()
    {
        $roleSuperAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);

        $permissions = [
            [
                'group_name' => 'Website Settings',
                'permissions' => [
                    'settings',
                    'currency',
                    'language',
                ],
            ],
        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);
            }
        }

        $roleSuperAdmin->givePermissionTo([
            'settings',
            'currency',
            'language',
        ]);
    }
}
