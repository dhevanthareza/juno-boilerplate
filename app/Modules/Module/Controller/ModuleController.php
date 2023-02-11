<?php 

namespace App\Modules\Module\Controller;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Module\Model\ModuleModel;
use Illuminate\Http\Request;

class ModuleController extends Controller {
    public function index(Request $request)
    {
        return view('Module::index');
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $employees = ModuleModel::paginate($per_page);
        return JsonResponseHandler::setResult($employees)->send();
    }

    public function create()
    {
        // show create form
    }

    public function store(Request $request)
    {   
        // $payload = $request->all();
        // $path = $request->file('photo')->storePubliclyAs('public/employee_photo', $payload['fullname'] . ".jpg");
        // $payload['photo'] = $path; 
        // $employee = EmployeeModel::create($payload);
        // return JsonResponseHandler::setResult($employee)->send();
    }

    public function show($id)
    {
        // $employee = EmployeeModel::where('id', $id)->first();
        // return JsonResponseHandler::setResult($employee)->send();
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
        // $delete = EmployeeModel::where('id', $id)->delete();
        // return JsonResponseHandler::setResult($delete)->send();
    }
}