<?php
namespace Framework;

/**
 * @author aduartem
 */

class ControllerFactory
{
    public static function build($controller)
    {
        $className 	= ucfirst($controller) . "Controller";
        $class 		= "\\App\Controller\\" . $className;
        if(class_exists($class))
            return new $class();
        else
            return NULL;
    }
}