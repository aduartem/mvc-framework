<?php
namespace Framework;

/**
 * @author aduartem
 */

class Security
{
    public static function xssClean($aData)
    {
        $aResult = array();
        foreach($aData as $key => $data)
        {
            if(is_array($data))
            {
                foreach($data as $index => $arr)
                {
                    $data[$index] = htmlspecialchars($arr);
                }
                $aResult[$key] = $data;
            }
            elseif(is_string($data))
            {
                $aResult[$key] = htmlspecialchars($data);
            }
            else
            {
                $aResult[$key] = $data;
            }
        }
        return $aResult;
    }
}