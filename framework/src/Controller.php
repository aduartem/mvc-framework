<?php
namespace Framework;

/**
 * @author aduartem
 */

class Controller
{
    private $_controller;
    private $_action;

    public function __construct($controller = NULL, $action = NULL)
    {
        $this->_controller  = $controller;
        $this->_action      = $action;
    }

    public function setController($controller)
    {
        $this->_controller = $controller;
    }

    public function setAction($action)
    {
    	$this->_action = $action;
    }

    public function action($aParams, $aMethodParameters = array())
    {
    	$action = $this->_action;

        if( ! method_exists($this->_controller, $action))
        {
            error('404');
            exit();
        }
        call_user_func_array(array($this->_controller, $this->_action), $aMethodParameters);
    }
}