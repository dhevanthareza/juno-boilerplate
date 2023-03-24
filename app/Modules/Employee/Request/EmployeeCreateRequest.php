<?php

namespace App\Modules\Employee\Request;

use App\Request\AppFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'dob' => ['required', 'date_format:Y-m-d'],
            'level' => ['required', 'string'],
            'ktp_photo' => ['required', 'mimes:jpg,jpeg,png']
        ];
    }
    
}
