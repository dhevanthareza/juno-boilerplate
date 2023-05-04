<?php

namespace App\Modules\UserPref\Requests;

use App\Request\AppFormRequest;


class UserPrefCreateRequest extends AppFormRequest
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