<?php

/**
 * @license Apache 2.0
 */

namespace SwagPhp;

/**
 * Logger reports the parser and validation messages.
 */
class Logger
{
    /**
     * Singleton
     * @var Logger
     */
    public static $instance;

    /**
     * @var \Closure
     */
    public $log;

    protected function __construct()
    {
        /**
         * @param \Throwable|string $entry
         * @param int $type Error type
         */
        $this->log = function ($entry, $type) {
            if ($entry instanceof \Throwable) {
                $entry = $entry->getMessage();
            }

            \trigger_error($entry, $type);
        };
    }

    /**
     * @return Logger
     */
    public static function getInstance(): Logger
    {
        if (self::$instance === null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    /**
     * Log a Swagger warning.
     * @param \Throwable|string $entry
     */
    public static function warning($entry): void
    {
        $handler = self::getInstance()->log;
        $handler($entry, \E_USER_WARNING);
    }

    /**
     * Log a Swagger notice.
     * @param \Throwable|string $entry
     */
    public static function notice($entry): void
    {
        $handler = self::getInstance()->log;
        $handler($entry, \E_USER_NOTICE);
    }
}
