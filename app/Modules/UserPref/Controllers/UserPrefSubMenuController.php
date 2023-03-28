<?php

namespace App\Modules\UserPref\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\UserPref\Repositories\UserPrefRepository;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class UserPrefSubMenuController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('UserPref::user-pref-sub-menu.index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = UserPrefRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }
}
