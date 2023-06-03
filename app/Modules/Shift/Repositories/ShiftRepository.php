<?php

namespace App\Modules\Shift\Repositories;

use App\Modules\Shift\Models\Shift;

class ShiftRepository
{
    public static function datatable($per_page = 15)
    {
        $data = Shift::paginate($per_page);
        return $data;
    }
    public static function get($shift_id)
    {
        $shift = Shift::where('id', $shift_id)->first();
        return $shift;
    }
    public static function create($shift)
    {
        $shift = Shift::create($shift);
        return $shift;
    }

    public static function update($shift_id, $shift)
    {
        Shift::where('id', $shift_id)->update($shift);
        $shift = Shift::where('id', $shift_id)->first();
        return $shift;
    }

    public static function delete($shift_id)
    {
        $delete = Shift::where('id', $shift_id)->delete();
        return $delete;
    }
}
