<?php

namespace App\Modules\Employee\Controller;

use App\Handler\JsonResponseHandler;
use App\Handler\UploadFileHandler;
use App\Http\Controllers\Controller;
use App\Modules\Employee\Repositories\EmployeeRepository;
use App\Modules\Employee\Request\EmployeeCreateRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        return view('Employee::index');
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $employees = EmployeeRepository::datatable($per_page);
        return JsonResponseHandler::setResult($employees)->send();
    }

    public function create()
    {
        return view('Employee::create');
    }

    public function store(EmployeeCreateRequest $request)
    {
        $payload = $request->all();
        $payload['photo'] = UploadFileHandler::handle("", "", $request->file('photo'));
        $employee = EmployeeRepository::create($payload);
        return JsonResponseHandler::setResult($employee)->send();
    }

    public function show($id)
    {
        $employee = EmployeeRepository::get($id);
        return JsonResponseHandler::setResult($employee)->send();
    }

    public function edit($id)
    {
        return view('Employee:edit');
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        $path = $request->file('photo')->storePubliclyAs('public/employee_photo', $payload['fullname'] . ".jpg");
        $payload['photo'] = $path;
        $employee = EmployeeRepository::update($id, $payload);
        return JsonResponseHandler::setResult($employee)->send();
    }

    public function destroy($id)
    {
        $delete = EmployeeRepository::delete($id);
        return JsonResponseHandler::setResult($delete)->send();
    }
}
