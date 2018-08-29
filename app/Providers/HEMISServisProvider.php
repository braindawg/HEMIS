<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HEMISServisProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $client = preg_replace('#^https?://#', '', request()->root()); //get base url without http or https
        $domainParts = explode(".", $client);

        // if (count($domainParts) == 4) {
        //     config(['subdomain' => $domainParts[0]]);    
        // }
        //$client = strtr($client, array('.' => '', 'www' => '', ',' => '', '/' => '')); //remove any commas or periods form client name                  
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
