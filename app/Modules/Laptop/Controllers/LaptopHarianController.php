<?php

namespace App\Modules\Laptop\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Laptop\Repositories\LaptopRepository;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class LaptopHarianController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('Laptop::laptop-harian.index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = LaptopRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }
}
