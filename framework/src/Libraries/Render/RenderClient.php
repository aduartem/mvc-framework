<?php
namespace Framework\Libraries\Render;

/**
 * @author aduartem
 */

class RenderClient
{
    private $strategy;

    public function __construct(){}

    public function render($aParams = array(), $xssClean = FALSE)
    {
        $this->strategy->render($aParams, $xssClean);
    }

    public function setRender(RenderInterface $strategy)
    {
        $this->strategy = $strategy;
    }
}