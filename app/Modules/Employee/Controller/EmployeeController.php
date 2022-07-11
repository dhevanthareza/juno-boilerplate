<?php

namespace App\Modules\Employee\Controller;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Employee\Request\EmployeeCreateRequest;
use EmployeeModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('karyawan::index');
    }

    public function create()
    {
        // show create form
    }
    
    public function store(EmployeeCreateRequest $request)
    {
        $validated = $request->validated();
        $employee = EmployeeModel::create($validated);
        return JsonResponseHandler::setResult($employee)->send();
    }

    public function show($id)
    {
        // show a single article
    }

    public function edit($id)
    {
        // show edit page
    }

    public function update(Request $request, $id)
    {
        // handle show edit page POST
    }

    public function destroy($id)
    {
        // delete a article
    }
}
