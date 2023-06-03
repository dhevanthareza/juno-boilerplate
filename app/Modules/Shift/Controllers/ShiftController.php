<?php

namespace App\Modules\Shift\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Shift\Repositories\ShiftRepository;
use App\Modules\Shift\Requests\ShiftCreateRequest;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('Shift::index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = ShiftRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }

    public function create()
    {
        return view('Shift::create');
    }

    public function store(ShiftCreateRequest $request)
    {
        $payload = $request->all();
        $shift = ShiftRepository::create($payload);
        return JsonResponseHandler::setResult($shift)->send();
    }

    public function show(Request $request, $id)
    {
        $shift = ShiftRepository::get($id);
        return JsonResponseHandler::setResult($shift)->send();
    }

    public function edit($id)
    {
        return view('Shift::edit', ['shift_id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        unset($payload['created_at']);
        unset($payload['updated_at']);
        $shift = ShiftRepository::update($id, $payload);
        return JsonResponseHandler::setResult($shift)->send();
    }

    public function destroy(Request $request, $id)
    {
        $delete = ShiftRepository::delete($id);
        return JsonResponseHandler::setResult($delete)->send();
    }
}
