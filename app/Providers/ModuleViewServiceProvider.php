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
        $this->loadViewsFrom(__DIR__.'/../Modules/Menu/Views', 'Menu');
        $this->loadViewsFrom(__DIR__.'/../Modules/User/Views', 'User');
        $this->loadViewsFrom(__DIR__.'/../Modules/Role/Views', 'Role');
        $this->loadViewsFrom(__DIR__.'/../Modules/Permission/Views', 'Permission');
        $this->loadViewsFrom(__DIR__.'/../Modules/Module/Views', 'Module');
        $this->loadViewsFrom(__DIR__.'/../Modules/Presensi/Views', 'Presensi');
        
        // VIEW_MARKER
        // Add view in the line below (DONT REMOVE THIS SECTION !!!!!!, because this line is LINE_MARKER used by Module Generator)
    }
}