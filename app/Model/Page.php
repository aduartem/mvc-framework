<?php
namespace App\Model;

use Framework\ORM\Model;

/**
 * @author aduartem
 */

class Page extends Model
{
    protected static $table = "page";
   
    public function getHtml($aParams)
    {
        $page = $this->select(array('html'))
                        ->where(array(
                            'controller'    => $aParams['controller'], 
                            'action'        => $aParams['action'],
                            'enabled'       => $aParams['enabled']
                        ))
                        ->getRow();

        return $page;
    }
}