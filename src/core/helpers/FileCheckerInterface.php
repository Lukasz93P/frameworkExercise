<?php
declare(strict_types=1);

namespace Core\Helpers;

interface FileCheckerInterface
{
    /**
     * @param string $relativePath
     * @return bool
     */
    public static function checkFileExistence(string $relativePath): bool;

    /**
     * @param array $possiblePatches
     * @param string $patch
     * @return string
     */
    public static function searchForFile(array &$possiblePatches, string $patch, bool $unset): string;

}