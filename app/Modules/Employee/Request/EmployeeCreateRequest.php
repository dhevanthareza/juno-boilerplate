<?php

namespace App\Modules\Employee\Request;

use App\Request\AppFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nip' => ['required', 'string'],
            'dob' => ['required', 'date_format:Y-m-d'],
            'fullname' => ['required', 'string'],
            'address' => ['required', 'string'],
            'photo' => ['required', 'mimes:jpg,jpeg,png'],
            'ktp_photo' => ['required', 'mimes:jpg,jpeg,png']
        ];
    }
    
}
