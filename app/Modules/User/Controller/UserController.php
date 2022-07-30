<?php

namespace App\Modules\User\Controller;

use App\Handler\JsonResponseHandler;
use App\Handler\JsonResponseType;
use App\Http\Controllers\Controller;
use App\Modules\User\Model\UserModel;
use App\Modules\User\Request\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginPage(Request $request)
    {
        return view('User::login');
    }
    public function login(UserLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $remember_me = $request->input('remember_me');

        $user = UserModel::where('username', $username)->orWhere('email', $username)->with(['roles'])->first();
        if ($user == null) {
            return JsonResponseHandler::setCode(JsonResponseType::ERROR)
                ->setStatus(400)
                ->setMessage("User tidak ditemukan")
                ->send();
        }
        $password_valid = Hash::check($password, $user->password);
        if (!$password_valid) {
            return JsonResponseHandler::setCode(JsonResponseType::ERROR)
                ->setStatus(400)
                ->setMessage("Password Salah")
                ->send();
        }
        Auth::login($user, $remember_me);
        return JsonResponseHandler::setCode(JsonResponseType::SUCCESS)
            ->setMessage("Berhasil Login")
            ->setResult($user)
            ->send();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return JsonResponseHandler::setMessage("Logout Berhasil")->send();
    }
}
