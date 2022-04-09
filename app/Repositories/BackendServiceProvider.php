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

    }
}
?>
