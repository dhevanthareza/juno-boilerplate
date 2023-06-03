<?php

namespace App\Modules\Jabatan\Requests;

use App\Request\AppFormRequest;


class JabatanCreateRequest extends AppFormRequest
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
            
        
				'name.required' => 'Nama Jabatan tidak boleh kosong',
			];
    }

}     