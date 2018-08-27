<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [ //App\Events\filename
            'App\Listeners\EventListener',//App\Listeners\file name
        ],
        'App\Events\Event2' => [ //App\Events\filename
            'App\Listeners\EventListener2',//App\Listeners\file name
        ],
        //run php artisan event:generate and will create events folder with files in array
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
