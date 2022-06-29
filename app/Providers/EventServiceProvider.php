<?php

namespace App\Providers;

use App\Events\SendWelcomeEmailToGabinete;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\NewGabineteCreated::class => [
            \App\Listeners\SendWelcomeEmailToGabinete::class,
        ],
        \App\Events\NewUserCreated::class => [
            \App\Listeners\SendWelcomeEmailToUser::class,
        ],
        \App\Events\UserReseted::class => [
            \App\Listeners\SendEmailResetToUser::class,
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
