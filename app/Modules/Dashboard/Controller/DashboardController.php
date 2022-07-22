<?php

namespace App\Modules\Dashboard\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('Dashboard::index');
    }
}
