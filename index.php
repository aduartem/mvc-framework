<?php
/**
 * FRONT CONTROLLER
 *
 */

spl_autoload_register(function ($class){
	
	$prefix 	= "Framework\\";
	$dir 		= "framework/src/";
	$class 		= str_replace($prefix, $dir, $class);
	$file 		= dirname(__FILE__) . DIRECTORY_SEPARATOR . str_replace("\\", "/", $class) . ".php";

	if(file_exists($file) && is_readable($file))
		require_once $file;
	else
		echo "File does not exist";
});

require_once __DIR__ . '/vendor/autoload.php';

define("FCPATH", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("CONTROLLER_PATH", FCPATH."app/Controller/");
define("MODEL_PATH", FCPATH."app/Model/");
define("VIEW_PATH", FCPATH."app/View/");
define("HELPER_PATH", FCPATH."app/Helper/");
define("FILE_PATH", FCPATH."public/file/");

require_once "app/Config/config.php";
require_once "framework/src/Helpers/Core.php";
// Opcional
require_once "framework/src/Helpers/Vendor.php";

use Framework\Bootstrap;

if( ! isCLI())
{
	Bootstrap::main();
}
else
{
	echo 'PHP CLI' . PHP_EOL;
	\App\Controller\CliController::main($argv);
}
?>