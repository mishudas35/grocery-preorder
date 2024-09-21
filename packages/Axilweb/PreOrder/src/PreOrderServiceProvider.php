<?php
namespace axilweb\PreOrder;

use Illuminate\Support\ServiceProvider;

class PreOrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register package services here
    }

//    public function boot()
//    {
//        // Load package resources
//        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
//        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'preorder');
//        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
//        $this->publishes([
//            __DIR__ . '/../config/preorder.php' => config_path('preorder.php'),
//        ], 'config');
//    }
    public function boot()
    {
        // Load your package routes, views, migrations, etc.
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
