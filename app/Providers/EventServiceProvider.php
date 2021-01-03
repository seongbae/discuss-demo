<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Seongbae\Discuss\Events\NewReply;
use Seongbae\Discuss\Events\NewThread;
use Seongbae\Discuss\Listeners\NotifyChannelSubscribers;
use Seongbae\Discuss\Listeners\NotifyThreadSubscribers;

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
        NewThread::class => [
            NotifyChannelSubscribers::class,
        ],
        NewReply::class => [
            NotifyThreadSubscribers::class,
        ]
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
