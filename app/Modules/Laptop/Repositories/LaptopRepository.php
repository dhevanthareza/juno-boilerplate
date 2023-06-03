<?php

namespace App\Modules\Laptop\Repositories;

use App\Modules\Laptop\Models\Laptop;

class LaptopRepository
{
    public static function datatable($per_page = 15)
    {
        $data = Laptop::paginate($per_page);
        return $data;
    }
    public static function get($laptop_id)
    {
        $laptop = Laptop::where('id', $laptop_id)->first();
        return $laptop;
    }
    public static function create($laptop)
    {
        $laptop = Laptop::create($laptop);
        return $laptop;
    }

    public static function update($laptop_id, $laptop)
    {
        Laptop::where('id', $laptop_id)->update($laptop);
        $laptop = Laptop::where('id', $laptop_id)->first();
        return $laptop;
    }

    public static function delete($laptop_id)
    {
        $delete = Laptop::where('id', $laptop_id)->delete();
        return $delete;
    }
}
