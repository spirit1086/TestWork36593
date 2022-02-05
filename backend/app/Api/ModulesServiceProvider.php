<?php

namespace App\Api;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $modules = config("module.modules");

        if($modules)
	    {
	        foreach($modules as $module)
            {
                    if(file_exists(__DIR__.'/'.$module.'/Routes/routes.php'))
                    {
                        $this->loadRoutesFrom(__DIR__.'/'.$module.'/Routes/routes.php');
                    }

                    if(is_dir(__DIR__.'/'.$module.'/Migrations'))
                    {
                        $this->loadMigrationsFrom(__DIR__.'/'.$module.'/Migrations');
                    }

                    if(is_dir(__DIR__.'/'.$module.'/Lang'))
                    {
                         $this->loadTranslationsFrom(__DIR__.'/'.$module.'/Lang', $module);
                    }
            }
         }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
