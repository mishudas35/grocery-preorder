<?php
namespace axilweb\PreOrder;

use Illuminate\Support\ServiceProvider;

class PreOrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register package services here
    }
    public function boot()
    {
        // Load your package routes, views, migrations, etc.
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../src/database/migrations');
    }
}
