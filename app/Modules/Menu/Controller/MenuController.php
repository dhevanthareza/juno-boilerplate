<?php
namespace App\Modules\Menu\Controller;

use App\Handler\JsonResponseHandler;
use App\Http\Controllers\Controller;
use App\Modules\User\Model\UserModel;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller {
    public function mine() {
        $user = UserModel::where('id', Auth::user()->id)->first();
        return JsonResponseHandler::setResult(Auth::user())->send();
    }
}