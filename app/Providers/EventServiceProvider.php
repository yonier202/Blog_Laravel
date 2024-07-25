<?php

namespace App\Providers;

use App\Events\CommentCreated;
use App\Listeners\NotifyAuthor;
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
        CommentCreated::class => [ //cuando se ejecute este evento se ejecute el oyente NotifyAuthor
            NotifyAuthor::class
        ]
        // php artisan event:generate
        // CommentCreated::class => [ //cuando se ejecute este evento se ejecute el oyente NotifyAuthor
        //     NotifyAuthor::class
        // ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        \App\Models\Post::observe( \App\Observers\PostObserver::class); //INSTANCIAR EL OBSERVE AL POST
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
