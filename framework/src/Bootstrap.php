<?php
namespace Framework;

use Framework\ControllerFactory;
use Framework\Controller;

/**
 * @author aduartem
 */

class Bootstrap
{
    public static $uriSegments;

    public static $controller;

    public static $action;

    private static $fileController;

    public static function main()
    {
        self::$uriSegments      = self::parseUri();
        self::$controller       = ( !empty(self::$uriSegments[0])) ? self::$uriSegments[0] : CONTROLLER_DEFAULT;
        self::$action           = ( !empty(self::$uriSegments[1])) ? self::$uriSegments[1] : ACTION_DEFAULT;
        self::$fileController   = CONTROLLER_PATH . ucfirst(self::$controller) . "Controller.php";
        self::router();
    }

    private static function router()
    {
        if( ! file_exists(self::$fileController))
        {
            error('404');
        }
        else
        {
            if(session_id() == '')
                session_start();

            $oController = ControllerFactory::build(self::$controller);

            if( is_null($oController))
            {
                error('404');
            }
            else
            {
                $app = new Controller($oController, self::$action);
                $aParams = $_REQUEST;

                $aMethodParameters = array();
                if(count(self::$uriSegments) > 2)
                {
                    foreach(self::$uriSegments as $key => $arr)
                    {
                        if($key > 1)
                            $aMethodParameters[] = $arr;
                    }
                }
                $app->action($aParams, $aMethodParameters);
            }
        }
    }

    private static function parseUri()
    {
        return explode('/', ltrim(rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/"), "/"));
    }
}