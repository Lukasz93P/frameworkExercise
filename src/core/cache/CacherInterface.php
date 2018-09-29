<?php
declare(strict_types=1);

namespace Core\Cache;

interface CacherInterface
{
    /**
     * @param string $key
     * @param $value
     * @param int|null $expire
     * @return mixed
     */
    public function putIntoCache(string $key, $value, int $expire = null);

    /**
     * @param string $key
     * @return mixed
     */
    public function getFromCache(string $key);

    /**
     * @param string $key
     * @return mixed
     */
    public function deleteFromCache(string $key);

    /**
     * @return mixed
     */
    public function clearAllCache();
}