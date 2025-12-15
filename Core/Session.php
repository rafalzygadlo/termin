<?php

namespace Core;
 
class Session
{
    protected const FLASH_KEY = 'flash_messages';

    /**
     * Starts the session if it's not already started.
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Sets a value in the session.
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Gets a value from the session.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Sets a "flash" message that will be available only for the next request.
     * @param string $key
     * @param mixed $value
     */
    public static function flash(string $key, $value)
    {
        self::start();
        $_SESSION[self::FLASH_KEY][$key] = $value;
    }

    /**
     * Gets a "flash" message and removes it from the session.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getFlash(string $key, $default = null)
    {
        self::start();
        $message = $_SESSION[self::FLASH_KEY][$key] ?? $default;
        unset($_SESSION[self::FLASH_KEY][$key]);
        return $message;
    }
            
}
