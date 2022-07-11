<?php
namespace App\Handler;

use Illuminate\Http\Request;
use Exception;

class ThrowException {
    public static function make($result = [], $code = 400, $message = null) {
        app('Illuminate\Http\Request')->merge(['meta_error' => [
            'result' => $result,
            'code' => $code,
            'message' => $message
        ]]);
        throw new Exception($message);
    }
}