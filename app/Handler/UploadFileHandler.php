<?php

namespace App\Handler;

use App\Exceptions\AppException;
use App\Handler\ThrowException;
use App\Type\JsonResponseType;
use Illuminate\Support\Facades\Log;

class UploadFileHandler
{
    /**
     * Handles file upload and returns the path where the file was stored
     *
     * @param string $targetDir The target directory where the file will be stored
     * @param string $fileName The name of the file will be stored
     * @param Request $file The request data from user
     * @param array $allowedExtensions An array of allowed file extensions
     * @return string The path where the file was stored
     * @throws ThrowException If the file upload fails
     */
    public static function handle($file, $targetDir = "", $fileName = "", $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'])
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $targetDir = $targetDir === "" ? 'public/uploads' : $targetDir;
        $fileName = $fileName === "" ? uniqid('', true) . '.' . $extension : $fileName . $extension;

        $messages = "Upload file activity on directory: " . $targetDir . " with filename: " . $fileName;

        // Checking for malicious activity by file extensions
        if (!in_array($extension, $allowedExtensions)) {
            throw new AppException("System warning that you do a malicious activity", $code=JsonResponseType::INTERNAL_SERVER_ERROR, 401);
        }

        // Create a log for monitoring file uploads on server
        Log::channel('custom')->info($messages);

        $file->move(base_path($targetDir), $fileName);

        return $targetDir . "/" . $fileName;
    }
}
