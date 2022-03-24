<?php

namespace App\App\Providers;

use App\Http\Auth\Events\UserFortgotsPassword;
use App\Http\Auth\Events\UserRegistered;
use App\Http\Auth\Listeners\AssingDefaultRole;
use App\Http\Auth\Listeners\SendMailPasswordRecovery;
use App\Http\Client\Contract\Events\ChangedManagerUser;
use App\Http\Client\Contract\Listeners\UpdatePortfolio;
use App\Http\Contract\Incorporation\Events\IncorporationCreated;
use App\Http\Contract\Incorporation\Listeners\AssignUserToIncorporation;
use App\Http\Supplier\Orders\Events\OrderCreated;
use App\Http\Supplier\Orders\Items\Events\BreakdownChanged;
use App\Http\Supplier\Orders\Items\Events\BreakdownCreated;
use App\Http\Supplier\Orders\Items\Events\DeleteCompletedBreakdown;
use App\Http\Supplier\Orders\Items\Listeners\CheckIfBreakdownWasClosed;
use App\Http\Supplier\Orders\Items\Listeners\CloseBreakdown;
use App\Http\Supplier\Orders\Items\Listeners\CreateBreakdownChangeRow;
use App\Http\Supplier\Orders\Items\Listeners\UpdateBreakdownChangedColumns;
use App\Http\Supplier\Orders\Listeners\AssignOrderToUserPortfolio;
use App\Http\System\User\Events\AdminRegistersUser;
use App\Http\System\User\Listeners\SendEmailAccountCreated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegistered::class => [
           AssingDefaultRole::class
        ],
        UserFortgotsPassword::class => [
            SendMailPasswordRecovery::class
        ],
        AdminRegistersUser::class => [
            SendEmailAccountCreated::class
        ],
        DeleteCompletedBreakdown::class => [
            CloseBreakdown::class
        ],
        BreakdownChanged::class => [
            UpdateBreakdownChangedColumns::class,
            CreateBreakdownChangeRow::class
        ],
        OrderCreated::class => [
            AssignOrderToUserPortfolio::class
        ],
        BreakdownCreated::class => [
            CheckIfBreakdownWasClosed::class
        ],
        ChangedManagerUser::class => [
            UpdatePortfolio::class
        ],
        IncorporationCreated::class => [
            AssignUserToIncorporation::class
        ]
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
