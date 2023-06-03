<?php

namespace App\Modules\Shift\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Shift\Repositories\ShiftRepository;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class RekapShiftController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('Shift::rekap-shift.index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = ShiftRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }
}
