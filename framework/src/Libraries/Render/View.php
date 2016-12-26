<?php
namespace Framework\Libraries\Render;

/**
 * @author aduartem
 */

class View implements RenderInterface
{
    public function __construct(){}

    public function render($aParams = array(), $xssClean = FALSE)
    {
        renderView($aParams, $xssClean);
    }
}