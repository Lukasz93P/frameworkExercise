<?php
declare(strict_types=1);

namespace Core\Session;

class Session
{
    /**
     * @param int|null $expirationTime
     * @param int|null $regenerationTime
     * @return bool|void
     */
    public static function start(int $expirationTime = null, int $regenerationTime = null)
    {
        if ($regenerationTime) {
            return static::startWithRegeneration($regenerationTime);
        } elseif ($expirationTime) {
            return static::startWithExpiration($expirationTime);
        } else {
            return session_start();
        }
    }

    /**
     * @param int $expirationTime
     * @return bool|void
     */
    public static function startWithExpiration(int $expirationTime)
    {
        session_start();
        $currentExpirationTime = static::get('secret_data');
        if (!empty($currentExpirationTime)) {
            if ($currentExpirationTime <= time()) {
                return session_destroy();
            }
        } else {
            return static::add(['secret_data' => time() + $expirationTime]);
        }
    }

    /**
     * @param int $regenerationTime
     */
    public static function startWithRegeneration(int $regenerationTime)
    {
        session_start();
        $currentRegenerationTime = static::get('secret_value');
        if ($currentRegenerationTime) {
            if ($currentRegenerationTime <= time()) {
                session_regenerate_id();
                static::add(['secret_value' => time() + $regenerationTime]);
            }
        } else {
            static::add(['secret_value' => time() + $regenerationTime]);
        }
    }

    /**
     * @param array $data
     */
    public static function add(array $data)
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = json_encode($value);
        }
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key)
    {
        if (!empty($_SESSION[$key])) {
            return json_decode($_SESSION[$key]);
        } else {
            return null;
        }
    }
}