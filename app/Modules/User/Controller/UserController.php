<?php

namespace App\Modules\User\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginPage(Request $request) {
        return view('User::login');
    }
}
