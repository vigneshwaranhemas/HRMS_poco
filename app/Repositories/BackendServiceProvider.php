<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\IPreOnboardingrepositories',
            'App\Repositories\PreOnboardingrepositories'
        );
        $this->app->bind(
            'App\Repositories\IHrPreonboardingrepositories',
            'App\Repositories\HrPreonboardingrepositories'
        );
        $this->app->bind(
            'App\Repositories\IBuddyrepositories',
            'App\Repositories\Buddyrepositories'
        );
       $this->app->bind(
        'App\Repositories\IAdminRepository',
        'App\Repositories\AdminRepository'
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
