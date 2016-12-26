<?php
/**
 * AMBIENTE APLICACION
 * Valores: development, qa, production
 */
define('ENVIRONMENT', 'production');

switch(ENVIRONMENT)
{
    case 'development':
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        break;
    case 'qa':
        error_reporting(E_WARNING);
        break;
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>='))
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        else
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        break;
    default:
        echo 'El ambiente de la aplicación no está configurado correctamente.';
        exit();
}

define('CONTROLLER_DEFAULT', 'Welcome');
define('ACTION_DEFAULT', 'index');

// SECURITY
define('XSS_PROTECTION', FALSE);