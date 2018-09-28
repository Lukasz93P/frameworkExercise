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
     * @param bool $unlink
     * @return string
     */
    public static function searchForFile(array &$possiblePatches, string $patch, bool $unset = false): string
    {
        $urlCount = count($possiblePatches);
        for ($x = 0; $x < $urlCount; $x++) {
            $patch .= DIRECTORY_SEPARATOR . ucfirst($possiblePatches[$x]);
            if (FileChecker::checkFileExistence("$patch.php")) {
                if ($unset) {
                    unset($possiblePatches[$x]);
                }
                return $patch;
            }
            if ($unset) {
                unset($possiblePatches[$x]);
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