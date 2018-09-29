<?php
declare(strict_types=1);

namespace Core\Upload;

use Core\Upload\FileUploaderInterface;

class CoreUploader implements FileUploaderInterface
{
    /**
     * @param array $file
     * @param string $destination
     * @param bool $required
     * @param array|null $requiredTypes
     * @return bool|mixed
     * @throws \Exception
     */
    public static function uploadFile(array $file, string $destination, bool $required = false, array $requiredTypes = null)
    {
        if ($required) {
            if (!static::checkFileExistence($file)) {
                throw new \Exception('File is required');
            }
        }
        if ($requiredTypes) {
            if (!static::checkRequiredType($file['tmp_name'], $requiredTypes)) {
                throw new \Exception('File type not available');
            }
        }
        return static::saveUploadedFile($file['tmp_name'], $destination);
    }

    /**
     * @param string $fileName
     * @param string $destination
     * @return bool
     */
    protected static function saveUploadedFile(string $fileName, string $destination): bool
    {
        try {
            move_uploaded_file($fileName, $destination);
        } catch (\Throwable $throwable) {
            return false;
        }
        return true;
    }

    /**
     * @param array $file
     * @return bool
     */
    protected static function checkFileExistence(array $file): bool
    {
        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            return false;
        }
        return true;
    }

    /**
     * @param string $fileName
     * @param array $requiredTypes
     * @return bool
     */
    protected static function checkRequiredType(string $fileName, array $requiredTypes): bool
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $fileName);
        if (!in_array($fileType, $requiredTypes)) {
            return false;
        }
        return true;
    }
}