<?php

namespace Core;
 
class Session
{
    protected const FLASH_KEY = 'flash_messages';

    /**
     * Starts the session if it's not already started.
     */
    public static function Start()
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
    public static function Set(string $key, $value)
    {
        self::Start();
        $_SESSION[$key] = $value;
    }

    /**
     * Gets a value from the session.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function Get(string $key, $default = null)
    {
        self::Start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Sets a "flash" message that will be available only for the next request.
     * @param string $key
     * @param mixed $value
     */
    public static function Flash(string $key, $value)
    {
        self::Start();
        $_SESSION[self::FLASH_KEY][$key] = $value;
    }

    /**
     * Gets a "flash" message and removes it from the session.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function GetFlash(string $key, $default = null)
    {
        self::Start();
        $message = $_SESSION[self::FLASH_KEY][$key] ?? $default;
        unset($_SESSION[self::FLASH_KEY][$key]);
        return $message;
    }

    /**
     * Flashes validation-related data (errors and old input) to the session.
     * @param array $errors The validation errors.
     * @param array $oldInput The old form input.
     */
    public static function FlashValidationState(array $errors, array $oldInput)
    {
        self::Flash('errors', $errors);
        self::Flash('old', $oldInput);
    }

    /**
     * Retrieves and clears validation-related data from the session.
     * @return array An array containing 'errors' and 'old' keys.
     */
    public static function GetValidationState(): array
    {
        return [
            'errors' => self::GetFlash('errors', []),
            'old' => self::GetFlash('old', [])
        ];
    }
            
}
