<?php
namespace Framework\Libraries\Render;

/**
 * @author aduartem
 */

interface RenderInterface
{
	public function render($aParams = array(), $xssClean = NULL);
}