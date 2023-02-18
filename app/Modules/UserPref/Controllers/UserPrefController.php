<?php

namespace App\Modules\UserPref\Controller;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\UserPref\Repositories\UserPrefRepository;
use App\Modules\UserPref\Request\UserPrefCreateRequest;
use Illuminate\Http\Request;

class UserPrefController extends Controller
{
    public function index(Request $request)
    {
        return view('UserPref::index');
    }

    public function datatable(Request $request)
    {
        $per_page = $request->input('per_page') != null ? $request->input('per_page') : 15;
        $data = UserPrefRepository::datatable($per_page);
        return JsonResponseHandler::setResult($data)->send();
    }

    public function create()
    {
        return view('UserPref:create');
    }

    public function store(UserPrefCreateRequest $request)
    {
        $payload = $request->all();
        ${$user_pref} = UserPrefRepository::create($payload);
        return JsonResponseHandler::setResult(${$user_pref})->send();
    }

    public function show($id)
    {
        ${$user_pref} = UserPrefRepository::get($id);
        return JsonResponseHandler::setResult(${$user_pref})->send();
    }

    public function edit($id)
    {
        return view('UserPref:edit');
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        ${$user_pref} = UserPrefRepository::update($id, $payload);
        return JsonResponseHandler::setResult(${$user_pref})->send();
    }

    public function destroy($id)
    {
        $delete = UserPrefRepository::delete($id);
        return JsonResponseHandler::setResult($delete)->send();
    }
}
