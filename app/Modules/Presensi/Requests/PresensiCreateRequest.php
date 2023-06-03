<?php

namespace App\Modules\Presensi\Requests;

use App\Request\AppFormRequest;


class PresensiCreateRequest extends AppFormRequest
{
    public function rules(): array
    {
        return [
				'nip' => 'required',
				'jam_datang' => 'required',
			];
    }

    public function messages(): array
    {
        return [
            
        
				'nip.required' => 'NIP tidak boleh kosong',
				'jam_datang.required' => 'Jam Datang tidak boleh kosong',
			];
    }

}     