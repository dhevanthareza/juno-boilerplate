<?php 
namespace App\Providers;

/**
* ServiceProvider
*
*/
class ModuleViewServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     *
     *
     * 
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Modules/Employee/Views', 'Employee');
        $this->loadViewsFrom(__DIR__.'/../Modules/Dashboard/Views', 'Dashboard');
    }
}