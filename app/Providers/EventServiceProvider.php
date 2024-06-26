<?php

namespace App\Providers;

use App\Events\GroupChatMessage;
use App\Events\SendSMS;
use App\Listeners\SendGroupChatMessageNotification;
use App\Listeners\SendSmsNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        GroupChatMessage::class => [
            SendGroupChatMessageNotification::class,
        ],
        \App\Events\SchoolExpense::class => [
            \App\Listeners\ExpensePdfNotification::class,
        ],
        SendSMS::class => [
            SendSmsNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
