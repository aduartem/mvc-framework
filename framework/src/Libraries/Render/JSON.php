<?php
namespace Framework\Libraries\Render;

/**
 * @author aduartem
 */

class JSON implements RenderInterface
{
    public function __construct(){}

    public function render($aParams = array(), $xssClean = FALSE)
    {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode(array(
                'status'  => strtolower($aParams['status']),
                'message' => $aParams['message'],
                'data'    => (isset($aParams['data'])) ? $aParams['data'] : ''
        ));
    }
}