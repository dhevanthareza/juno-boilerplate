<?php

namespace App\Modules\Employee\Repositories;

use App\Modules\Employee\Model\EmployeeModel;

class EmployeeRepository
{
    public static function datatable($per_page = 15)
    {
        $employees = EmployeeModel::paginate($per_page);
        return $employees;
    }
    public static function get($employee_id)
    {
        $employee = EmployeeModel::where('id', $employee_id)->first();
        return $employee;
    }
    public static function create($employee)
    {
        $employee = EmployeeModel::create($employee);
        return $employee;
    }

    public static function update($employee_id, $employee)
    {
        EmployeeModel::where('id', $employee_id)->update($employee);
        $employee = EmployeeModel::where('id', $employee_id)->first();
        return $employee;
    }

    public static function delete($employee_id)
    {
        $delete = EmployeeModel::where('id', $employee_id)->delete();
        return $delete;
    }
}
