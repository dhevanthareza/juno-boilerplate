<?php

namespace App\Modules\Menu\Repository;

use App\Modules\Menu\Model\MenuModel;
use App\Modules\Module\Model\ModuleModel;
use App\Modules\Permission\Model\PermissionModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MenuRepository
{
    public static function generateMenu($menu_payload)
    {
        DB::beginTransaction();
        try {
            self::store($menu_payload);
            $module = ModuleModel::where('id', $menu_payload['module_id'])->first();
            if ($module != null) {
                $module_name = join("", explode(" ", $module->name));
                $module_name = join("", explode("-", $module_name));
                $module_path = app_path() . '/Modules' . '/' . $module_name;
                $menu_title = $menu_payload['name'];
                $menu_name = join("", explode(" ", $menu_payload['name']));
                $menu_name = join("", explode("-", $menu_name));
                $menu_path = strtolower(join("-", explode(" ", $menu_payload['name'])));

                // TODO : Generate Controller
                self::generateController($module_path, $module_name, $menu_name, $menu_path);

                // TODO : Generate route
                self::generateRoute($module_name, $menu_name, $menu_path);

                // TODO : Generate index file
                self::generateIndexFile($module_path, $menu_path, $menu_title);
            }

            DB::commit();
        } catch (Exception $err) {
            DB::rollBack();
        }
    }

    private static function generateController($module_path, $module_name, $menu_name, $menu_path)
    {
        $controller_string = File::get(base_path() . "/template/ControllerMenu.php");
        $controller_string = str_replace('module_name', $module_name, $controller_string);
        $controller_string = str_replace('menu_name', $menu_name, $controller_string);
        $controller_string = str_replace('menu_path', $menu_path, $controller_string);

        File::put($module_path . '/Controllers//' . $menu_name . 'Controller.php', $controller_string);
    }

    private static function generateRoute($module_name, $menu_name, $menu_path)
    {
        // Generate use
        $file_path = base_path()  . "/app/Modules/$module_name/routes.php";
        $search_string = "// USE MARKER (DONT DELETE THIS LINE)";
        $insert_string = "use App\Modules\\{$module_name}\Controllers\\{$menu_name}Controller;\n";
        $file_lines = file($file_path);
        $matched_line_index = 18;
        foreach ($file_lines as $index => $line) {
            if (str_contains($line, $search_string)) {
                $matched_line_index = $index;
            }
        }

        array_splice($file_lines, $matched_line_index, 0, $insert_string);
        $modified_file_contents = implode("", $file_lines);
        file_put_contents($file_path, $modified_file_contents);

        // Generate route prefix
        $file_lines = file($file_path);
        $file_path = base_path()  . "/app/Modules/{$module_name}/routes.php";
        $search_string = "// SUB MENU MARKER (DONT DELETE THIS LINE)";
        $insert_string = <<<END
            Route::prefix('/{$menu_path}')->group(function() {
                Route::get('/', [{$menu_name}Controller::class, 'index']);
            });\n
        END;
        $file_lines = file($file_path);
        $matched_line_index = 18;
        foreach ($file_lines as $index => $line) {
            if (str_contains($line, $search_string)) {
                $matched_line_index = $index;
            }
        }

        array_splice($file_lines, $matched_line_index, 0, $insert_string);
        $modified_file_contents = implode("", $file_lines);
        file_put_contents($file_path, $modified_file_contents);
    }

    private static function generateIndexFile($module_path, $menu_path, $menu_title)
    {
        File::makeDirectory($module_path . '/Views//' . $menu_path, 0755);

        $index_string = <<<END
        @extends('dashboard_layout.index')
        @section('content')
        <div class="page-inner" id="{$menu_path}">
            <div class="card">
                <div class="card-header">
                    <h1>{$menu_title}</h1>
                </div>
                <div class="card-body">
                    <h2> Some Content</h2>
                </div>
            </div>
        </div>
        @endsection
        END;
        File::put($module_path . "/Views/{$menu_path}/" . "index.blade.php", $index_string);
    }

    public static function store($menu_payload)
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

    public static function storeV2($menu_payload)
    {
        $menu = MenuModel::create($menu_payload);
        $menu = MenuModel::where('id', $menu->id)->first();
        $menu_code = strtolower(join("_", explode(" ", $menu->name)));
        $is_group_menu = !isset($menu_payload['module_id']) || $menu_payload['module_id'] == null;
        $permission_payload = [
            [
                'code' => 'create-' . ($is_group_menu ? 'group-' : '') . $menu_code,
                'description' => 'Create ' . $menu->name,
                'menu_id' => $menu->id
            ],
            [
                'code' => 'read-' . ($is_group_menu ? 'group-' : '') . $menu_code,
                'description' => 'Read ' . $menu->name,
                'menu_id' => $menu->id
            ],
            [
                'code' => 'update-' . ($is_group_menu ? 'group-' : '') . $menu_code,
                'description' => 'Update ' . $menu->name,
                'menu_id' => $menu->id
            ],
            [
                'code' => 'delete-' . ($is_group_menu ? 'group-' : '') . $menu_code,
                'description' => 'Delete ' . $menu->name,
                'menu_id' => $menu->id
            ]
        ];
        PermissionModel::insert($permission_payload);

        $path = $menu->path !== null ? "\"{$menu->path}\"" : 'null';
        $parent_id = $menu->parent_id !== null ? "\"{$menu->parent_id}\"" : 'null';
        $module_id = $menu->module_id !== null ? "\"{$menu->module_id}\"" : 'null';
        $icon = $menu->icon !== null ? "\"{$menu->icon}\"" : 'null';
        $migration_string = <<<END
        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;
        use App\Modules\Menu\Model\MenuModel;
        use App\Modules\Permission\Model\PermissionModel;

        return new class extends Migration
        {
            /**
             * Run the migrations.
             */
            public function up(): void
            {
                \$menu = MenuModel::create([
                    'name' => '{$menu->name}',
                    'path' => {$path},
                    'description' => '{$menu->description}',
                    'parent_id' => {$parent_id},
                    'module_id' => {$module_id},
                    'created_at' => '{$menu->created_at}',
                    'updated_at' => '{$menu->updated_at}',
                    'icon' => '{$icon}',
                ]);
                \$menu_code = strtolower(join("_", explode(" ", \$menu->name)));
                \$is_group_menu = {$is_group_menu};
                \$permission_payload = [
                    [
                        'code' => 'create-' . (\$is_group_menu ? 'group-' : '') . \$menu_code,
                        'description' => 'Create ' . \$menu->name,
                        'menu_id' => \$menu->id
                    ],
                    [
                        'code' => 'read-' . (\$is_group_menu ? 'group-' : '') . \$menu_code,
                        'description' => 'Read ' . \$menu->name,
                        'menu_id' => \$menu->id
                    ],
                    [
                        'code' => 'update-' . (\$is_group_menu ? 'group-' : '') . \$menu_code,
                        'description' => 'Update ' . \$menu->name,
                        'menu_id' => \$menu->id
                    ],
                    [
                        'code' => 'delete-' . (\$is_group_menu ? 'group-' : '') . \$menu_code,
                        'description' => 'Delete ' . \$menu->name,
                        'menu_id' => \$menu->id
                    ]
                ];
                PermissionModel::insert(\$permission_payload);
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
               
            }
        };

        END;
        $migration_name = date('Y_m_d_His') . "_create_menu_{$menu['name']}_record";
        File::put(base_path() . '/database/migrations/' . $migration_name . ".php", $migration_string);
        DB::table('migrations')->insert(['migration' => $migration_name, 'batch' => 1]);
        return $menu;
    }
}
