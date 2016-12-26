<?php
/**
 * @author aduartem
 */

use Framework\Bootstrap;
use Framework\Security;

use Framework\Libraries\Render\RenderClient;
use Framework\Libraries\Render\Layout;

if( ! function_exists("renderView"))
{
    function renderView($aParams = array(), $xssClean = FALSE, $noCache = TRUE)
    {
        header('Content-type: text/html; charset=utf-8');

        if($noCache)
        {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", FALSE);
            header("Pragma: no-cache");
        }

        if( ! empty($aParams))
        {
            if($xssClean || XSS_PROTECTION)
            {
                $aParams = Security::xssClean($aParams);
            }

            extract($aParams);
        }

        if( ! empty($aParams['VIEW']))
            $file = VIEW_PATH . $aParams['VIEW'] . '.tpl';
        else
            $file = VIEW_PATH . strtolower(Bootstrap::$controller) . '/' . Bootstrap::$action . '.tpl';

        if( ! file_exists($file))
            error('404');
        else
            require $file;
    }
}

if( ! function_exists("xssClean"))
{

}

if( ! function_exists("isCLI"))
{
    function isCLI()
    {
        return (php_sapi_name() === 'cli');
    }
}

if( ! function_exists("loadHelpers"))
{
    function loadHelpers()
    {
        $dir = opendir(HELPER_PATH);
        while($file = readdir($dir))
        {
            if( ! is_dir($file))
            {
                if(strpos($file, '.php') !== FALSE)
                    require_once HELPER_PATH . $file;
            }
        }
    }
}

if( ! function_exists("exportToCSV"))
{
    function exportToCSV($filename, $rows, $cols)
    {
        array_unshift($rows, $cols);
        $fp = fopen(FILE_PATH.$filename.".csv", "w");
        foreach($rows as $key => $row)
        {
            fputcsv($fp, $row, ';', ' ');
        }
        fclose($fp);
        return $key;
    }
}

if( ! function_exists('error'))
{
    function error($code = 404, $message = '')
    {
        $layout = new RenderClient();
        $layout->setRender(new Layout());
        $layout->render(array('VIEW' => 'error/404'), FALSE);
    }
}