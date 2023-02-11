<?php
namespace App\Modules\Menu\Repository;
use App\Modules\Menu\Model\MenuModel;
use App\Modules\Permission\Model\PermissionModel;

class MenuRepository {
    public static function createMenu($menu_payload)
    {
        $menu = MenuModel::create($menu_payload);
        $menu_code = strtolower(join("_", explode(" ", $menu->name)));
        $permission_payload = [
            [
                'code' => 'create-' . $menu_code,
                'description' => 'Create ' . $menu->name,
                'menu_id' => $menu->id
            ],
            [
                'code' => 'read-' . $menu_code,
                'description' => 'Read ' . $menu->name,
                'menu_id' => $menu->id
            ],
            [
                'code' => 'update-' . $menu_code,
                'description' => 'Update ' . $menu->name,
                'menu_id' => $menu->id
            ],
            [
                'code' => 'delete-' . $menu_code,
                'description' => 'Delete ' . $menu->name,
                'menu_id' => $menu->id
            ]
        ];
        PermissionModel::insert($permission_payload);
        return $menu;
    }
}