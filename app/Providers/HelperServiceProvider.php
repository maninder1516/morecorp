<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // For a single file
        // $file = app_path('Helpers/Helper.php');
        // if (file_exists($file)) {
        //     require_once($file);
        // }

        foreach (glob(\app_path('Helpers').'/*.php') as $file) {
            require_once $file;
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
