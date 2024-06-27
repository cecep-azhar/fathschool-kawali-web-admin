<?php

use App\Models\Currency;
use App\Models\GallerySlider;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\User;
use App\Models\WorkingDays;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\GallerySliderSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class WebsiteSettingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_Website_settings_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([
            SettingSeeder::class,
            LanguageSeeder::class,
            CurrencySeeder::class,
        ]);

        // Visit the setting general index page
        $response = $this->get(route('settings.general'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Index')
                ->tap(function ($page) {
                    $page->has('timezones.419');
                    $page->has('languages');
                    $page->has('currencies');
                    $page->has('system.timezone');
                    $page->has('system.app_debug_mode');
                    $page->has('system.language');
                    $page->has('system.currency');
                    $page->has('system.currency_format');
                    $page->has('system.start_day_of_week');
                    $page->has('system.date_format');
                });
        });
    }

    public function test_admin_can_do_basic_settings_update()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'logo_type' => 'image',
            'app_name' => 'Sun Shine School',
            'school_code' => '1231',
            'text_logo_name' => 'Sun Shine School',
            'dark_logo' => UploadedFile::fake()->create('dark_logo.png', 200),
            'light_logo' => UploadedFile::fake()->create('light_logo.png', 200),
            'favicon' => UploadedFile::fake()->create('favicon.png', 200),
            'app_email' => 'FathSchool@mail.com',
            'app_phone' => '01**42290**',
            'principal_name' => 'Sun Shine School Principal',
            'app_address' => 'Dhaka, Bangladesh',
            'app_description' => 'Sun Shine School is a constituent institution of the University of Dhaka',
        ];

        // Send a PUT request to update the settings
        $response = $this->put(route('settings.update', 1), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);

        // Assert that the app_name in the database is updated correctly
        expect(Setting::first()->app_name)->toBe('Sun Shine School');

        // Assert that the principal_name in the database is updated correctly
        expect(Setting::first()->principal_name)->toBe('Sun Shine School Principal');

    }

    public function test_admin_can_do_system_settings_update()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'timezone' => 'UTC',
            'app_debug_mode' => true,
            'language' => 'en',
            'currency' => 'USD',
            'currency_format' => '12345678.00',
            'overdue' => 0,
            'date_format' => 'd_m_Y',
            'start_day_of_week' => 0,
        ];

        // Send a PUT request to update the settings
        $response = $this->put(route('settings.system.update', 1), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
    }

    public function test_admin_can_do_schedule_settings_update()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'sunday' => false,
            'monday' => true,
            'tuesday' => true,
            'wednesday' => false,
            'thursday' => true,
            'friday' => true,
            'saturday' => true,
        ];

        // Send a PUT request to update the settings
        $response = $this->put(route('settings.schedule.update', 1), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(WorkingDays::first()->wednesday)->toBe(0);
    }

    public function test_admin_can_visit_Website_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([
            GallerySliderSeeder::class,
            SocialLinkSeeder::class,
        ]);

        // Visit the setting general index page
        $response = $this->get(route('settings.website'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Website')
                ->tap(function ($page) {
                    $page->has('sliders.0');
                    $page->has('socialLinks.data.0');
                });
        });
    }

    public function test_admin_can_create_slider_gallery()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'image' => UploadedFile::fake()->create('slider.jpg', 1024),
        ];

        // Send a PUT request to update the settings
        $response = $this->post(route('settings.website.slider.store'), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(GallerySlider::count())->toBe(1);
    }

    public function test_admin_fail_to_create_slider_gallery_for_wrong_file_extension()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'image' => UploadedFile::fake()->create('slider.mp3', 1024),
        ];

        // Send a PUT request to update the settings
        $response = $this->post(route('settings.website.slider.store'), $data)
            ->assertSessionHasErrors(['image']);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(GallerySlider::count())->toBe(0);
    }

    public function test_admin_can_delete_slider_gallery()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'image' => UploadedFile::fake()->create('slider.jpg', 1024),
        ];
        GallerySlider::create($data);

        // Send a delete request to remove the slider
        $response = $this->delete(route('settings.website.slider.delete', 1));

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(GallerySlider::count())->toBe(0);
    }

    public function test_social_media_setting_store()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'name' => 'Slack',
            'url' => 'https://slack.com',
            'icon' => UploadedFile::fake()->create('slider.jpg', 1024),
        ];

        // Send a store request for store data
        $response = $this->post(route('settings.social.store'), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(SocialLink::count())->toBe(1);
    }

    public function test_social_media_settings_store_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'icon' => UploadedFile::fake()->create('slider.jpg', 1024),
        ];

        // Send a store request for store data
        $response = $this->post(route('settings.social.store'), $data)
            ->assertSessionHasErrors(['name', 'url']);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(SocialLink::count())->toBe(0);
    }

    public function test_social_media_setting_update()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);
        SocialLink::create([
            'name' => 'Facebook',
            'url' => 'https://facebook.com',
        ]);

        // Prepare the data for settings update
        $data = [
            'name' => 'Slack',
            'url' => 'https://slack.com',
            'icon' => UploadedFile::fake()->create('slider.jpg', 1024),
        ];

        // Send a store request for update data
        $response = $this->put(route('settings.social.update', 1), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(SocialLink::first()->name)->toBe('Slack');
    }

    public function test_social_media_settings_update_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        SocialLink::create([
            'name' => 'Facebook',
            'url' => 'https://facebook.com',
        ]);

        // Prepare the data for settings update
        $data = [
            'icon' => UploadedFile::fake()->create('slider.jpg', 1024),
        ];

        // Send a store request for update data
        $response = $this->put(route('settings.social.update', 1), $data)
            ->assertSessionHasErrors(['name', 'url']);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(SocialLink::first()->name)->toBe('Facebook');
    }

    public function test_social_media_setting_delete()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);
        SocialLink::create([
            'name' => 'Facebook',
            'url' => 'https://facebook.com',
        ]);

        // Send a store request for update data
        $response = $this->delete(route('settings.social.destroy', 1));

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(SocialLink::count())->toBe(0);
    }

    public function test_admin_can_visit_currency_setting_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([
            CurrencySeeder::class,
        ]);

        // Visit the setting general index page
        $response = $this->get(route('settings.currency'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Currency')
                ->tap(function ($page) {
                    $page->has('currencies.data.0');
                });
        });
    }

    public function test_currency_setting_store()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);

        // Prepare the data for settings update
        $data = [
            'name' => 'United State Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'rate' => 100
        ];

        // Send a store request for store data
        $response = $this->post(route('settings.currency.store'), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(Currency::count())->toBe(1);
    }

    public function test_social_currency_store_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Prepare the data for settings update
        $data = [];

        // Send a store request for store data
        $response = $this->post(route('settings.currency.store'), $data)
            ->assertSessionHasErrors(['name', 'code', 'symbol']);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(Currency::count())->toBe(0);
    }

    public function test_currency_setting_update()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);
        $createData = [
            'name' => 'United State Dollar',
            'code' => 'USD',
            'symbol' => '$',
        ];
        Currency::create($createData);

        // Prepare the data for settings update
        $data = [
            'name' => 'Bangladeshi Taka',
            'code' => 'BDT',
            'symbol' => '$',
            'rate' => 100
        ];

        // Send a store request for store data
        $response = $this->put(route('settings.currency.update', 1), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(Currency::first()->name)->toBe('Bangladeshi Taka');
    }

    public function test_social_currency_update_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $createData = [
            'name' => 'United State Dollar',
            'code' => 'USD',
            'symbol' => '$',
        ];
        Currency::create($createData);

        // Prepare the data for settings update
        $data = [];

        // Send a store request for store data
        $response = $this->put(route('settings.currency.update', 1), $data)
            ->assertSessionHasErrors(['name', 'code', 'symbol']);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(Currency::first()->name)->toBe('United State Dollar');
    }

    public function test_currency_setting_delete()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the settings table
        $this->seed(SettingSeeder::class);
        $createData = [
            'name' => 'Bangladeshi Taka',
            'code' => 'BDT',
            'symbol' => 'TK',
        ];
        Currency::create($createData);

        // Send a delete request for delete data
        $response = $this->delete(route('settings.currency.destroy', 1));

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(Currency::count())->toBe(0);
    }

    public function test_recaptcha_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $response = $this->get(route('settings.recaptcha.index'));
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Recaptcha')
                ->tap(function ($page) {
                    $page->has('site_key');
                    $page->has('secret');
                    $page->has('status');
                });
        });
    }

    public function test_smtp_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $response = $this->get(route('settings.smtp'));
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/SMTP')
                ->tap(function ($page) {
                    $page->has('host');
                    $page->has('port');
                    $page->has('encryption');
                    $page->has('username');
                    $page->has('password');
                    $page->has('address');
                    $page->has('name');
                });
        });
    }

    public function test_payment_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $response = $this->get(route('settings.payment'));
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Payment')
                ->tap(function ($page) {

                    // paypal data check
                    $page->has('paypal.paypal_mode');
                    $page->has('paypal.paypal_sandbox_client_id');
                    $page->has('paypal.paypal_sandbox_client_secret');
                    $page->has('paypal.paypal_live_client_id');
                    $page->has('paypal.paypal_live_client_secret');
                    $page->has('paypal.paypal_active');

                    // stripe data check
                    $page->has('stripe.stripe_key');
                    $page->has('stripe.stripe_secret');
                    $page->has('stripe.stripe_active');

                    // midtrans data check
                    $page->has('midtrans.midtrans_merchant_id');
                    $page->has('midtrans.midtrans_client_key');
                    $page->has('midtrans.midtrans_server_key');
                    $page->has('midtrans.midtrans_active');
                    $page->has('midtrans.midtrans_live_mode');

                });
        });
    }

    public function test_other_setting_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Get the route and check response status code is 200 (OK)
        $response = $this->get(route('settings.other'));
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Other');
        });
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
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

        $roleAdmin->givePermissionTo([
            'settings',
        ]);
    }
}
