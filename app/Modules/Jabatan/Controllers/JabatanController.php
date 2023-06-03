<?php

namespace App\Modules\Jabatan\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Jabatan\Repositories\JabatanRepository;
use App\Modules\Jabatan\Requests\JabatanCreateRequest;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('Jabatan::index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = JabatanRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }

    public function create()
    {
        return view('Jabatan::create');
    }

    public function store(JabatanCreateRequest $request)
    {
        $payload = $request->all();
        $jabatan = JabatanRepository::create($payload);
        return JsonResponseHandler::setResult($jabatan)->send();
    }

    public function show(Request $request, $id)
    {
        $jabatan = JabatanRepository::get($id);
        return JsonResponseHandler::setResult($jabatan)->send();
    }

    public function edit($id)
    {
        return view('Jabatan::edit', ['jabatan_id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        unset($payload['created_at']);
        unset($payload['updated_at']);
        $jabatan = JabatanRepository::update($id, $payload);
        return JsonResponseHandler::setResult($jabatan)->send();
    }

    public function destroy(Request $request, $id)
    {
        $delete = JabatanRepository::delete($id);
        return JsonResponseHandler::setResult($delete)->send();
    }
}
