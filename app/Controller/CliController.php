<?php
namespace App\Controller;

use Framework\Libraries\Scraping\SpiderFactory;
use Framework\Libraries\Scraping\SpiderController;

/**
 * @author aduartem
 */

class CliController
{
    /**
     * Example:
     * php index.php make:model dog
     * php index.php make:model cat tbl_cat
     * php index.php make:controller person
     */
    public static function main(array $aArg = array())
    {
        if( ! isCLI()) die("Debe correr este programa desde línea de comandos.");

        if(empty($aArg[1])) die("Falta parámetro para CliController::main()");


        $aExplode = explode(":", $aArg[1]); 
        $run      = $aExplode[0];
        $make     = $aExplode[1];

        if($run === 'make')
        {
            switch($make)
            {
                case 'model':
                // echo 'epa!'; die();
                    $class = ( ! empty($aArg[2])) ? $aArg[2] : '';
                    $table = ( ! empty($aArg[3])) ? $aArg[3] : '';
                    self::makeModel($class, $table);
                    break;
                case 'controller':
                    self::makeController($aArg[2]);
                    break;
                default:
                    echo 'values: controller or model';
                    break;
            }
        }
    }

    private static function makeModel($className, $tableName = '')
    {
        $className  = ucfirst($className);
        $fileName   = MODEL_PATH . $className . ".php";

        if(file_exists($fileName) && is_readable($fileName))
        {
            echo 'File exists';
            return;
        }
        elseif(file_exists($fileName) &&  ! is_readable($fileName))
        {
            echo "The file exists but is not readable";
            return;
        }

        $fh = fopen($fileName, "w");
        fwrite($fh, "<?php" . PHP_EOL);
        fwrite($fh, "namespace App\Model;" . PHP_EOL . PHP_EOL);
        fwrite($fh, "use Framework\ORM\Model;" . PHP_EOL . PHP_EOL);
        fwrite($fh, "class ".$className." extends Model" . PHP_EOL);
        fwrite($fh, "{" . PHP_EOL);
        $var = "$";
        fwrite($fh, "\tprotected static ".$var."table = '".$tableName."';" . PHP_EOL . PHP_EOL);
        fwrite($fh, "\tpublic function __construct(){}" . PHP_EOL);
        fwrite($fh, "}" . PHP_EOL);
        fclose($fh);

        if( ! file_exists($fileName))
        {
            echo 'The file was not created.';
            return;
        }

        if( ! is_readable($fileName))
        {
            echo "The file is not readable";
            return;
        }

        echo 'The file was successfully created.';
    }

    private static function makeController($className)
    {
        $className  = ucfirst($className) . "Controller";
        $fileName   = CONTROLLER_PATH . $className . ".php";

        if(file_exists($fileName) && is_readable($fileName))
        {
            echo 'File exists';
            return;
        }
        elseif(file_exists($fileName) &&  ! is_readable($fileName))
        {
            echo "The file exists but is not readable";
            return;
        }

        $fh = fopen($fileName, "w");
        fwrite($fh, "<?php" . PHP_EOL);
        fwrite($fh, "namespace App\Controller;" . PHP_EOL . PHP_EOL);
        fwrite($fh, "class ".$className." extends AppController" . PHP_EOL);
        fwrite($fh, "{" . PHP_EOL);
        fwrite($fh, "\tpublic function __construct()" . PHP_EOL);
        fwrite($fh, "\t{" . PHP_EOL);
        fwrite($fh, "\t\tparent::__construct();" . PHP_EOL);
        fwrite($fh, "\t}" . PHP_EOL . PHP_EOL);
        fwrite($fh, "\tpublic function index()" . PHP_EOL);
        fwrite($fh, "\t{" . PHP_EOL);
        fwrite($fh, "\t\t" . PHP_EOL);
        fwrite($fh, "\t}" . PHP_EOL);
        fwrite($fh, "}" . PHP_EOL);
        fclose($fh);

        if( ! file_exists($fileName))
        {
            echo 'The file was not created.';
            return;
        }

        if( ! is_readable($fileName))
        {
            echo "The file is not readable";
            return;
        }

        echo 'The file was successfully created.';
    }

    private static function spider($spiderName)
    {
        if( empty($spiderName))
        {
            echo "missing parameter." . PHP_EOL;
            return;
        }

        $oSpider = SpiderFactory::build($spiderName);

        if( ! is_null($oSpider))
            $oSpider->run();
    }
}