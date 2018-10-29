<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Route::model('user', \App\User::class);
        Route::model('issue', \App\Models\Issue::class);
        Route::model('group', \App\Models\Group::class);
        Route::model('leave', \App\Models\Leave::class);
        Route::model('course', \App\Models\Course::class);
        Route::model('dropout', \App\Models\Dropout::class);        
        Route::model('teacher', \App\Models\Teacher::class);
        Route::model('subject', \App\Models\Subject::class);
        Route::model('student', \App\Models\Student::class);
        Route::model('transfer', \App\Models\Transfer::class);
        Route::model('university', \App\Models\University::class);
        Route::model('department', \App\Models\Department::class);
        Route::model('role', \Spatie\Permission\Models\Role::class);
        Route::model('announcement', \App\Models\Announcement::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
