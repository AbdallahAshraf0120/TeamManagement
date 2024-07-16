<?php
namespace wdd\teammanagement;

use Illuminate\Support\ServiceProvider;

class TeamManagementServiceProvider extends ServiceProvider
{
    public function boot(){


        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../src/resources/views', 'wdd/teammanagement');

        $this->loadMigrationsFrom(__DIR__.'/../src/database/migrations');
        
        $this->publishes([
            __DIR__.'/../src/Database/Migrations' => database_path('migrations'),
        ]);

        
        $this->publishes([
            __DIR__.'/public/assets' => public_path('vendor/wdd_teammanagement/assets'),
        ], 'public');


    



    }
    

    

    public function register(){
    
    }




    public const HOME = '/home';
    public const ADMIN = '/admin/dashboard';

    
}