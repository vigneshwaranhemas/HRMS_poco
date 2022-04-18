<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register() {

        $this->app->bind(
            'App\Repositories\IAdminRepository',
            'App\Repositories\AdminRepository'
        );

        $this->app->bind(
            'App\Repositories\IBuddyRepository',
            'App\Repositories\BuddyRepository'
        );
        $this->app->bind(
            'App\Repositories\IEventCategoryrepositories',
            'App\Repositories\EventCategoryrepositories'
        );
        $this->app->bind(
            'App\Repositories\IEventTypeRepositories',
            'App\Repositories\EventTyperepositories'
        );
        $this->app->bind(
            'App\Repositories\IEventRepositories',
            'App\Repositories\EventRepositories'
        );
        $this->app->bind(
            'App\Repositories\IPreOnboardingrepositories',
            'App\Repositories\PreOnboardingrepositories'
        );
        $this->app->bind(
            'App\Repositories\IHrPreonboardingrepositories',
            'App\Repositories\HrPreonboardingrepositories'
        );
        $this->app->bind(
            'App\Repositories\IProfileRepositories',
            'App\Repositories\ProfileRepositories'
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}


?>
