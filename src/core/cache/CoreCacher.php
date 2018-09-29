<?php
declare(strict_types=1);

namespace Core\Cache;

use Core\Cache\Adapters\AbstractCacherAdapter;
use Core\Cache\CacherInterface;

class CoreCacher implements CacherInterface
{
    /**
     * @var AbstractCacherAdapter
     */
    protected $cacherAdapter;

    /**
     * CoreCacher constructor.
     * @param AbstractCacherAdapter $cacherAdapter
     */
    public function __construct(AbstractCacherAdapter $cacherAdapter)
    {
        $this->cacherAdapter = $cacherAdapter;
    }

    /**
     * @param string $key
     * @param $value
     * @param int|null $expire
     * @return mixed
     */
    public function putIntoCache(string $key, $value, int $expire = null)
    {
        return $this->cacherAdapter->putIntoCache($key, $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getFromCache(string $key)
    {
        return $this->cacherAdapter->getFromCache($key);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function deleteFromCache(string $key)
    {
        return $this->cacherAdapter->deleteFromCache($key);
    }

    /**
     * @return mixed
     */
    public function clearAllCache()
    {
        return $this->cacherAdapter->clearAllCache();
    }
}