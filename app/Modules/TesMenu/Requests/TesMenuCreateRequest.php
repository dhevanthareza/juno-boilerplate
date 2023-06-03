<?php

namespace App\Modules\TesMenu\Requests;

use App\Request\AppFormRequest;


class TesMenuCreateRequest extends AppFormRequest
{
    public function rules(): array
    {
        return [
				'name' => 'required',
				'level' => 'required',
			];
    }

    public function messages(): array
    {
        return [
            
        
				'name.required' => 'Nama tidak boleh kosong',
				'level.required' => 'Level tidak boleh kosong',
			];
    }

}     