<?php

namespace App\Providers;

use App\Events\StudentCreated;
use App\Events\StudentDeleted;
use App\Listeners\DeleteStudentInits;
use App\Listeners\InitStudentTables;
use App\Models\StudentDetails;
use App\Observers\StudentObserver;
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
        StudentCreated::class => [
            InitStudentTables::class
        ],
        StudentDeleted::class => [
            DeleteStudentInits::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        StudentDetails::observe(StudentObserver::class);
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
