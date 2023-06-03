<?php

namespace App\Modules\Shift\Requests;

use App\Request\AppFormRequest;


class ShiftCreateRequest extends AppFormRequest
{
    public function rules(): array
    {
        return [
				'name' => 'required',
			];
    }

    public function messages(): array
    {
        return [
            
        
				'name.required' => 'Name tidak boleh kosong',
			];
    }

}     