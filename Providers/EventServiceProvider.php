<?php

namespace Modules\Admin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Admin\Events\Auth\UserRegisteredEvent;
use Modules\Admin\Listeners\Auth\UserRegisteredEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegisteredEvent::class => [
            UserRegisteredEventListener::class
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
}
