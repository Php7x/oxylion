<?php


namespace Php7x\oXylion\Component\Debug;

/**
 * Registers all the debug tools.
 *
 * @author Bartosz Zwierzchowski - <vedget.mbox@gmail.com>
 */
class Debug
{
    /**
     * @var bool
     * Program debbug mode hook
     */
    private static $_enabled = false;

    /**
     * Enables the debug tools.
     *
     * This method registers an error handler and an exception handler.
     *
     * If the oXylion ClassLoader component is available, a special
     * class loader is also registered.
     *
     * @param int  $errorReportingLevel The level of error reporting you want
     * @param bool $displayErrors       Whether to display errors (for development) or just log them (for production)
     */
    public static function enable($ErrorReporting = E_ALL, $ErrorDisplay = true) {
        if (static::$_enabled) {
            return;
        }

        static::$_enabled = true;

        if (null !== $errorReportingLevel) {
            error_reporting($errorReportingLevel);
        } else {
            error_reporting(E_ALL);
        }

        if ('cli' !== PHP_SAPI) {
            ini_set('display_errors', 0);
        }
        elseif ($displayErrors && (!ini_get('log_errors') || ini_get('error_log'))) {
            // CLI - display errors only if they're not already logged to STDERR
            ini_set('display_errors', 1);
        }

        //TODO: import from Symfony3.0 DebugClassLoader
        //DebugClassLoader::enable();
    }
}
