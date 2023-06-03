<?php

namespace App\Modules\Laptop\Requests;

use App\Request\AppFormRequest;


class LaptopCreateRequest extends AppFormRequest
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
            
        
				'name.required' => 'Nama tidak boleh kosong',
			];
    }

}     