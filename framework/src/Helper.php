<?php
namespace Framework;

/**
 * @author aduartem
 */

class Helper
{
	public static function load($helper)
	{
		require_once HELPER_PATH . $helper . ".php";
	}
}