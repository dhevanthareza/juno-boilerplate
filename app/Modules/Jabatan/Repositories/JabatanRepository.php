<?php

namespace App\Modules\Jabatan\Repositories;

use App\Modules\Jabatan\Models\Jabatan;

class JabatanRepository
{
    public static function datatable($per_page = 15)
    {
        $data = Jabatan::paginate($per_page);
        return $data;
    }
    public static function get($jabatan_id)
    {
        $jabatan = Jabatan::where('id', $jabatan_id)->first();
        return $jabatan;
    }
    public static function create($jabatan)
    {
        $jabatan = Jabatan::create($jabatan);
        return $jabatan;
    }

    public static function update($jabatan_id, $jabatan)
    {
        Jabatan::where('id', $jabatan_id)->update($jabatan);
        $jabatan = Jabatan::where('id', $jabatan_id)->first();
        return $jabatan;
    }

    public static function delete($jabatan_id)
    {
        $delete = Jabatan::where('id', $jabatan_id)->delete();
        return $delete;
    }
}
