<?php

namespace App\Modules\Module\Repository;

use App\Modules\Menu\Repository\MenuRepository;
use App\Modules\Module\Model\ModuleModel;
use Illuminate\Support\Facades\File;

class ModuleRepository
{
    public static function create($module_payload, $menu_payload)
    {
        // TODO : Create module data
        $module = ModuleModel::creeat($module_payload);

        // TODO : create menu data
        $menu = MenuRepository::createMenu($menu_payload);

        // TODO : Create module and menu file
        self::generateModuleFile($module_payload);
    }
    public static function generateModuleFile($module_payload)
    {
        $module_name = join("", explode(" ", $module_payload['name'])); // Patter must Be ModuleName, Employee, UserPreferences, modulename
        $module_url = strtolower(join("-", explode(" ", $module_payload['name']))); // module-name, employee, user-preferences
        $module_variable = strtolower(join("_", explode(" ", $module_payload['name']))); // module_name, employee, user_preferences
        $module_path = app_path() . '/Modules' . '/' . $module_name; // returning app/Modules/$module_name
        // Generate Folder
        self::generateFolder($module_path);
        // Generate Route
        self::generateRoute($module_path, $module_name, $module_url, $module_variable);
        // Create DB Migration
        // Create Model
        self::generateModel($module_name, $module_variable, $module_path);
        // Create Repository
        self::generateRepository();
        // Create Controller
        // Create View
    }
    private static function generateFolder($module_path)
    {

        if (!File::exists($module_path)) {
            File::makeDirectory($module_path, 0755, true);
        }
        File::makeDirectory($module_path . '/Models', 0755);
        File::makeDirectory($module_path . '/Repositories', 0755);
        File::makeDirectory($module_path . '/Controllers', 0755);
        File::makeDirectory($module_path . '/Views', 0755);
    }

    private static function generateRoute($module_path, $module_name, $module_url, $module_variable)
    {
        // creating routes.php in module
        $route_string = <<<END
        <?php
        namespace App\Modules\\{$module_name};

        use App\Modules\\{$module_name}\Controller\\{$module_name}Controller;
        use Illuminate\Support\Facades\Route;

        Route::prefix('/{$module_url}')->group(function() {
            Route::get('/', [{$module_name}Controller::class, 'index']);
            Route::get('/datatable', [{$module_name}Controller::class, 'datatable']);
            Route::get('/create', [{$module_name}Controller::class, 'create']);
            Route::post('/', [{$module_name}Controller::class, 'store']);
            Route::get('/{{$module_variable}_id}', [{$module_name}Controller::class, 'show']);
            Route::get('/{{$module_variable}_id}/edit', [{$module_name}Controller::class, 'edit']);
            Route::put('/{{$module_variable}_id}', [{$module_name}Controller::class, 'update']);
            Route::delete('/{{$module_variable}_id}', [{$module_name}Controller::class, 'destroy']);
        });
        END;
        File::put($module_path . '/' . 'routes.php', $route_string);

        // require above file in routes/web.php
        $file_path = base_path()  . "/routes/web.php";
        $search_string = "ROUTE_MARKER";
        $insert_string = "    require app_path('Modules/{$module_name}/routes.php');\n";

        $file_lines = file($file_path);

        $matched_line_index = 18;
        foreach($file_lines as $index => $line) {
            if(str_contains($line, $search_string)) {
                $matched_line_index = $index;
            }
        }

        array_splice($file_lines, $matched_line_index-1, 0, $insert_string);
        $modified_file_contents = implode("", $file_lines);
        file_put_contents($file_path, $modified_file_contents);
    }

    private static function generateModel($module_name, $module_variable, $module_path)
    {
        $model_string = <<<END
        <?php
        namespace App\Modules\\{$module_name}\Model;
        use Illuminate\Database\Eloquent\Model;
        use Illuminate\Database\Eloquent\SoftDeletes;

        class {$module_name} extends Model
        {
            use SoftDeletes;
            protected \$table = '{$module_variable}';
            protected \$guarded = [];
        }
        END;

        File::put($module_path . '/Models//' . $module_name . '.php', $model_string);
    }

    private static function generateRepository() {
        
    }
}
