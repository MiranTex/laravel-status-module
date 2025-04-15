<?php

namespace Dev\LaravelStatusModule;

use Dev\LaravelStatusModule\Interfaces\StatusGroupAssociationInterface;
use Dev\LaravelStatusModule\Interfaces\StatusRepositoryInterface;
use Dev\LaravelStatusModule\Repository\StatusGroupAssociationRepository;
use Dev\LaravelStatusModule\Repository\StatusRepository;
use Dev\LaravelStatusModule\Services\StatusGroupService;
use Illuminate\Support\ServiceProvider;

class StatusModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->publishes([
            __DIR__.'/Migrations' => database_path('migrations')
        ]);
        $this->publishes([
            __DIR__.'/config/status_module.php' => config_path('status_module.php'),
        ]);

        

        class_alias(\Dev\LaravelStatusModule\Facades\StatusGroupFacade::class, 'StatusGroup');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/status_module.php', 'status_module'
        );

        $this->app->bind(
            StatusRepositoryInterface::class,
            function($app){
                return new StatusRepository();
            }
        );

        $this->app->bind(
            StatusGroupAssociationInterface::class,
            function($app){
                return new StatusGroupAssociationRepository();
            }
        );

        $this->app->singleton('statusGroupService', function($app){
            return new StatusGroupService(
                $app->make('Dev\LaravelStatusModule\Repository\StatusGroupRepository'),
                $app->make('Dev\LaravelStatusModule\Validators\StatusGroupValidator'),
                $app->make('Dev\LaravelStatusModule\Utils\SlugGenerator'),
                $app->make('Dev\LaravelStatusModule\Interfaces\StatusGroupAssociationInterface')
            );
        });
    }
}