<?php

namespace App\Http\Middleware;

use App\Handler\ThrowException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Facades\Log;

/**
 * VerifyUpload is a middleware that provides protection against malicious activities carried out by users, 
 * such as uploading files with SQL injection attacks or uploading backdoors to the server. 
 * It also includes a log monitoring feature that tracks any instances of malicious activity by users.
 * 
 * Example usage : 
 * Route::get('/[path]', [Controller::class, 'index'])->middleware('VerifyUpload:param1,param2,param3,...')
 * 
 */

class VerifyUpload
{

    public function handle(Request $request, Closure $next, ...$params)
    {
        $regxp = "\'|\"|\`|\=|\#|\+|\*|\/|\\|\;|\%|\@|\!|\~|\?|\$|\&|\||\(|\)|\{|\}|\[|\]|\^|\<|\>|\,";
        $data = [
            "status" => "malicious_activity",
            "message" => "System warning that you do a malicious activity"
        ];
        $date = date('Y-m-d');

        foreach ($params as $param) {
            $file = $request->file($param);
            $messages = "Upload file Acitivity : " . $file . " on " . $date;

            // Checking malicious activity by file extensions
            if (in_array(strtolower($file->getClientOriginalExtension()), ['php', 'pl', 'phtml', 'php1', 'php2', 'php3', 'php4', 'php5', 'php6', 'php7', 'php8', 'html', 'svg', 'xhtml', 'shtml'])) {
                Log::channel('custom')->info($messages);
                return ThrowException::make($file, 500, $data);
            }

            // Checking malicious activity by name of files
            if (preg_match($regxp, $file->getClientOriginalName())) {
                Log::channel('custom')->info($messages);
                return ThrowException::make($file, 500, $data);
            }
        }
        return $next($request);
    }
}
