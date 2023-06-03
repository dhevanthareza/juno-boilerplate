<?php

namespace App\Modules\Laptop\Controllers;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Laptop\Repositories\LaptopRepository;
use App\Modules\Laptop\Requests\LaptopCreateRequest;
use App\Modules\Permission\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    public function index(Request $request)
    {
        $permissions = PermissionRepository::getPermissionStatusOnMenuPath($request->path());
        return view('Laptop::index', ['permissions' => $permissions]);
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = LaptopRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }

    public function create()
    {
        return view('Laptop::create');
    }

    public function store(LaptopCreateRequest $request)
    {
        $payload = $request->all();
        $laptop = LaptopRepository::create($payload);
        return JsonResponseHandler::setResult($laptop)->send();
    }

    public function show(Request $request, $id)
    {
        $laptop = LaptopRepository::get($id);
        return JsonResponseHandler::setResult($laptop)->send();
    }

    public function edit($id)
    {
        return view('Laptop::edit', ['laptop_id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        unset($payload['created_at']);
        unset($payload['updated_at']);
        $laptop = LaptopRepository::update($id, $payload);
        return JsonResponseHandler::setResult($laptop)->send();
    }

    public function destroy(Request $request, $id)
    {
        $delete = LaptopRepository::delete($id);
        return JsonResponseHandler::setResult($delete)->send();
    }
}
