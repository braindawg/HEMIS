<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Validator::extend('valid_destination_department', function($attribute, $value, $parameters) {
            $student = \App\Models\Student::find(request()->student_id);
             
            return ($student and $student->department_id != $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->register(TelescopeServiceProvider::class);
    }
}
