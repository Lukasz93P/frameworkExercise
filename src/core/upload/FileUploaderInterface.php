<?php
declare(strict_types=1);

namespace Core\Upload;

interface FileUploaderInterface
{
    /**
     * @param array $file
     * @param string $destination
     * @param bool|false $required
     * @param array|null $requiredTypes
     * @return mixed
     */
    public static function uploadFile(array $file, string $destination, bool $required = false, array $requiredTypes = null);
}