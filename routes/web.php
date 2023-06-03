<?php

use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function () {
    require app_path('Modules/Employee/routes.php');
    require app_path('Modules/Dashboard/routes.php');
    require app_path('Modules/User/routes.php');
    require app_path('Modules/Menu/routes.php');
    require app_path('Modules/Role/routes.php');
    require app_path('Modules/Permission/routes.php');
    require app_path('Modules/Module/routes.php');
    require app_path('Modules/Presensi/routes.php');
    
    // ROUTE_MARKER
    // Add routes in the line below (DONT REMOVE THIS SECTION !!!!!!, because this line is LINE_MARKER used by Module Generator)
});


Route::get('/', function () {
    return redirect('/user/login');
});

// tes view blade dan layout admin
Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::post('/karyawan/tespost', [KaryawanController::class, 'tespost']);
Route::post('/karyawan/tessubmit', [KaryawanController::class, 'tessubmit']);

// tes asset vue di dalam module -> views
Route::get('/vue/karyawan/{filename}', function ($filename)
{
    if(preg_match('/[^a-zA-Z_\-0-9.]/i', $filename))
    {
        abort(403); //return 404 error if file not found
    }

    $path = base_path('app/Modules/karyawan/Views/'.$filename);
 
    if (!File::exists($path)) {
        abort(404); //return 404 error if file not found
    }
 
    $type = File::extension($path); //determine the file type
    if($type != 'js' && $type != 'vue'){
        abort(404); //return 404 error if file not found
    }
    $file = File::get($path); //get the file
 
    $response = Response::make($file, 200); //200 OK HTML Response
    $response->header("Content-Type", $type); //HTML filetype header
 
    return $response; //return file
});