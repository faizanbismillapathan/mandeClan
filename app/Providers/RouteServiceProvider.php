<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
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

       Route::middleware('web')
       ->namespace('App\Http\Controllers\admin')
       ->prefix('admin')
       ->group(base_path('routes/admin.php'));  
       
       Route::middleware('web')
       ->namespace('App\Http\Controllers\seller')
       ->prefix('seller')
       ->group(base_path('routes/seller.php'));  

       Route::middleware('web')
       ->namespace('App\Http\Controllers\customer')
       ->prefix('customer')
       ->group(base_path('routes/customer.php'));  


       Route::middleware('web')
       ->namespace('App\Http\Controllers\servicepartner')
       ->prefix('service-partner')
       ->group(base_path('routes/servicepartner.php'));  

       Route::middleware('web')
       ->namespace('App\Http\Controllers\service')
       ->prefix('service')
       ->group(base_path('routes/service.php'));  


       Route::middleware('web')
       ->namespace('App\Http\Controllers\admin')
       ->prefix('admin')
       ->group(base_path('routes/admin.php'));  
       
       
    
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
        

        Route::prefix('v1/frontendApi')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/frontendApi.php'));



        Route::prefix('v1/customerApi')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/customerApi.php'));

        Route::prefix('v1/sellerApi')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/sellerApi.php'));

        

        Route::prefix('v1/rvApi')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/rvApi.php'));

        

        Route::prefix('v1/serviceApi')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/serviceApi.php'));

    }
}
