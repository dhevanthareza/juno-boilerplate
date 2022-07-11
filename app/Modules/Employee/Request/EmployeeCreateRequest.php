<?php

namespace App\Modules\Employee\Request;

use App\Request\AppFormRequest;


class EmployeeCreateRequest extends AppFormRequest
{
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string'],
            'dob' => ['required', 'date_format:Y-m-d'],
            'address' => ['required', 'string'],
            'photo' => ['required', 'mimes:jpg,jpeg,png']
        ];
    }
    
}
