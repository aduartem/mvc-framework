<?php
namespace App\Controller;

use Framework\Security;
use Framework\Libraries\Render\RenderClient;
use Framework\Libraries\Render\View;
use Framework\Libraries\Render\Layout;
use Framework\Libraries\Render\JSON;

class AppController
{
	public function __construct()
    {

    }

    protected function view($aParams = array(), $xssClean = FALSE)
    {
        $layout = new RenderClient();
        $layout->setRender(new View());
        $layout->render($aParams, $xssClean);
    }

    protected function layout($aParams = array(), $xssClean = FALSE)
    {
        $layout = new RenderClient();
        $layout->setRender(new Layout());
        $layout->render($aParams, $xssClean);
    }

    protected function json($aParams = array(), $xssClean = FALSE)
    {
        $json = new RenderClient();
        $json->setRender(new JSON());
        $json->render($aParams, $xssClean);
    }
}