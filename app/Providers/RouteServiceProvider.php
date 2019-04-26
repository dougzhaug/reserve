<?php

namespace App\Providers;

use Dingo\Api\Http\Parser\Accept;
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

        switch (sld()){
            case 'api':
                $this->mapApiRoutes();
                break;
            case 'admin':
                $this->mapAdminRoutes();
                break;
            case 'company':
                $this->mapCompanyRoutes();
                break;
            case 'www':
                $this->mapWebRoutes();
                break;
            default:
                $this->mapWebRoutes();
        }
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
        Route::domain('www.' . config('app.tld'))
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::domain('admin.' . config('app.tld'))
            ->middleware('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "agent" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAgentRoutes()
    {
        Route::domain('agent.' . config('app.tld'))
            ->middleware('agent')
            ->namespace($this->namespace)
            ->group(base_path('routes/agent.php'));
    }

    /**
     * Define the "company" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapCompanyRoutes()
    {
        Route::domain('company.' . config('app.tld'))
            ->middleware('company')
            ->namespace($this->namespace)
            ->group(base_path('routes/company.php'));
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
        $accept = (new Accept(config('api.standardsTree'), config('api.subtype'), config('api.version'), config('api.defaultFormat')))->parse(request());

        $routeFile = $accept['version'] . '.php';

        Route::domain('api.' . config('app.tld'))
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/'.$routeFile));
    }
}
