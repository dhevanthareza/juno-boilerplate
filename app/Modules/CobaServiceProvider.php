<?php 
namespace App\Modules;

/**
* ServiceProvider
*
*/
class CobaServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Ini buat testing aja, jangan dilanjutin
     * yang real dibuat di ModulesServiceProvider
     * 
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/karyawan/Views', 'karyawan');
    }
}