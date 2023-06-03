<?php

namespace App\Modules\TesMenu\Repositories;

use App\Modules\TesMenu\Models\TesMenu;

class TesMenuRepository
{
    public static function datatable($per_page = 15)
    {
        $data = TesMenu::paginate($per_page);
        return $data;
    }
    public static function get($tes_menu_id)
    {
        $tes_menu = TesMenu::where('id', $tes_menu_id)->first();
        return $tes_menu;
    }
    public static function create($tes_menu)
    {
        $tes_menu = TesMenu::create($tes_menu);
        return $tes_menu;
    }

    public static function update($tes_menu_id, $tes_menu)
    {
        TesMenu::where('id', $tes_menu_id)->update($tes_menu);
        $tes_menu = TesMenu::where('id', $tes_menu_id)->first();
        return $tes_menu;
    }

    public static function delete($tes_menu_id)
    {
        $delete = TesMenu::where('id', $tes_menu_id)->delete();
        return $delete;
    }
}
