<?php

namespace App\Modules\Jabatan\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Jabatan\Repositories\JabatanRepository;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class RekapJabatanController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('Jabatan::rekap-jabatan.index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = JabatanRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }
}
