<?php

namespace App\Modules\TesMenu\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\TesMenu\Repositories\TesMenuRepository;
use App\Modules\TesMenu\Requests\TesMenuCreateRequest;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class TesMenuController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('TesMenu::index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = TesMenuRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }

    public function create()
    {
        return view('TesMenu::create');
    }

    public function store(TesMenuCreateRequest $request)
    {
        $payload = $request->all();
        $tes_menu = TesMenuRepository::create($payload);
        return JsonResponseHandler::setResult($tes_menu)->send();
    }

    public function show(Request $request, $id)
    {
        $tes_menu = TesMenuRepository::get($id);
        return JsonResponseHandler::setResult($tes_menu)->send();
    }

    public function edit($id)
    {
        return view('TesMenu::edit', ['tes_menu_id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        unset($payload['created_at']);
        unset($payload['updated_at']);
        $tes_menu = TesMenuRepository::update($id, $payload);
        return JsonResponseHandler::setResult($tes_menu)->send();
    }

    public function destroy(Request $request, $id)
    {
        $delete = TesMenuRepository::delete($id);
        return JsonResponseHandler::setResult($delete)->send();
    }
}
