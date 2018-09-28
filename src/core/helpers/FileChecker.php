<?php
declare(strict_types=1);

namespace Core\Helpers;

use Core\Helpers\FileCheckerInterface;

class FileChecker implements FileCheckerInterface
{
    /**
     * @var string
     */
    protected static $basePatch = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

    /**
     * @param string $relativePath
     * @return bool
     */
    public static function checkFileExistence(string $relativePath): bool
    {
        return file_exists(static::$basePatch . $relativePath);
    }

    /**
     * @param array $possiblePatches
     * @param string $patch
     * @param bool $unset
     * @return string
     */
    public static function searchForFile(array &$possiblePatches, string $patch, bool $unset = false): string
    {
        foreach($possiblePatches as $possiblePath){
            $patch .= DIRECTORY_SEPARATOR . ucfirst($possiblePath);
            if (FileChecker::checkFileExistence("$patch.php")) {
                if ($unset) {
                    array_shift($possiblePatches);
                }
                return $patch;
            }
            if ($unset) {
                array_shift($possiblePatches);
            }
        }
        return '';
    }

    /**
     * @return string
     */
    public static function basePatch(): string
    {
        return self::$basePatch;
    }
}