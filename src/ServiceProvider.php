<?php

namespace SimonWessel\TeamCityApi;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/teamcity.php' => config_path('teamcity.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/teamcity.php', 'teamcity');

        $config = config('teamcity');

        $this->app->singleton('teamcity', function() use($config) {
            return new TeamCityApi($config['url'], $config['username'], $config['password']);
        });
    }
}
