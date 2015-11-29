<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    protected $namespace = 'App\Http\Controllers';

    public function boot(Router $router) {
        $router->pattern('upc', '[0-9]+');

        parent::boot($router);
    }

    public function map(Router $router) {
        $router->group(['namespace' => $this->namespace], function($router) {
            foreach(glob(app_path('Http//Routes').'/*.php') as $file) {
                $this->app->make('App\\Http\\Routes\\'.basename($file, '.php'))->map($router);
            }
        });
    }

}
