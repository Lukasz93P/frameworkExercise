<?php
declare(strict_types=1);

namespace Core\Cache\Adapters;

use Core\Cache\CacherInterface;

abstract class AbstractCacherAdapter implements CacherInterface
{
    /**
     * @var CacherInterface
     */
    protected $cacher;

    /**
     * @param string $key
     * @param $value
     * @param int|null $expire
     * @return mixed
     */
    public abstract function putIntoCache(string $key, $value, int $expire = null);

    /**
     * @param string $key
     * @return mixed
     */
    public abstract function getFromCache(string $key);

    /**
     * @param string $key
     * @return mixed
     */
    public abstract function deleteFromCache(string $key);

    /**
     * @return mixed
     */
    public abstract function clearAllCache();
}
