<?php

namespace App\Modules\Menu\Controller;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\Menu\Model\MenuModel;
use App\Modules\Permission\Model\PermissionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function mine()
    {
        $user = Auth::user();
        $roles = $user->roles->toArray();
        $role_ids = array_map(function ($role) {
            return $role['id'];
        }, $roles);
        $menus = MenuModel::with(['childs' => function ($q) use ($role_ids) {
            $q->whereHas('permissions', function ($q) use ($role_ids) {
                $q->where('code', 'read')->whereHas('roles', function ($q) use ($role_ids) {
                    $q->whereIn('roles.id', $role_ids);
                });
            });
        }, 'permissions', 'permissions.roles'])->whereNull('parent_id')->where(function ($q) use ($role_ids) {
            $q->orWhereHas('permissions', function ($q) use ($role_ids) {
                $q->where('code', 'read')->whereHas('roles', function ($q) use ($role_ids) {
                    $q->whereIn('roles.id', $role_ids);
                });
            })->orHas('childs');
        })->get();
        return JsonResponseHandler::setResult($menus)->send();
    }

    public function index()
    {
        return view('Menu::index');
    }

    public function parentList()
    {
        $menus = MenuModel::where('parent_id', null)->get();
        return JsonResponseHandler::setResult($menus)->send();
    }

    public function all()
    {
        $menus = MenuModel::get();
        return JsonResponseHandler::setResult($menus)->send();
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $keyword = $request->input('keyword') != null ? $request->input('keyword') : null;
        $menus = MenuModel::with('parent')->search($keyword)->paginate($per_page);
        return JsonResponseHandler::setResult($menus)->send();
    }

    public function detail(Request $request, $menu_id)
    {
        $menu = MenuModel::where('id', $menu_id)->first();
        return JsonResponseHandler::setResult($menu)->send();
    }

    public function create()
    {
        return view('Menu::create');
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $menu = MenuModel::create($payload);
        return JsonResponseHandler::setResult($menu)->send();
    }

    public function edit(Request $request, $menu_id)
    {
        return view('Menu::edit', ['menu_id' => $menu_id]);
    }

    public function update(Request $request, $menu_id)
    {
        $payload = $request->all();
        unset($payload['created_at']);
        unset($payload['updated_at']);

        $menu = MenuModel::where('id', $menu_id)->update($payload);
        return JsonResponseHandler::setResult($menu)->send();
    }

    public function permissions(Request $request, $menu_id)
    {
        $permissions = PermissionModel::where('menu_id', $menu_id)->get();
        return JsonResponseHandler::setResult($permissions)->send();
    }
}
