<?php
namespace Framework\Libraries\Render;

/**
 * @author aduartem
 */

class Layout implements RenderInterface
{
	public function __construct(){}

	public function render($aParams = array(), $xssClean = FALSE)
	{
		$layout = ( ! empty($aParams['layout'])) ? $aParams['layout'] : 'default.tpl'; 
		require VIEW_PATH . 'layouts/' . $layout;
	}
}