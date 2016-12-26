<?php
namespace Framework\Libraries;

/**
 * @author aduartem
 */

class Validator
{
    public static function naturalNumbers($str)
    {
        if(preg_match("/^[0-9]+$/", $str))
            return TRUE;
        else
            return FALSE;
    }

    public static function naturalNumbersAndDecimal($str)
    {
        if(preg_match("/^([0-9]+\.+[0-9]|[0-9])+$/", $str))
            return TRUE;
        else
            return FALSE;
    }

    public static function onlyLetters($str)
    {
        if(preg_match("/^[a-z]+$/i", $str))
            return TRUE;
        else
            return FALSE;
    }

    public static function charactersLatinAmericanSpanish($str)
    {
        if(preg_match("/^[a-záéóóúàèìòùäëïöüñ\s]+$/i", $str))
            return TRUE;
        else
            return FALSE;
    }

    public static function numeric($num)
    {
        
    }

    public static function validEmail($str)
    {
        $pattern = "/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/";
        if(preg_match($pattern, $str))
            return TRUE;
        else
            return FALSE;
    }

    public static function required($data)
    {
        if(is_string($data))
        {
            if(empty($data))
                return FALSE;
            else
                return TRUE;
        }
        elseif(is_array($data))
        {
            foreach($data as $key => $element)
            {
                if(empty($element))
                    return FALSE;
            }
            return TRUE;
        }
    }

    public static function maxLength($str, $max)
    {
        if(strlen($str) > $max)
        {
            return FALSE;
        }
        return TRUE;
    }

    public static function minLength($str, $min)
    {
        if(strlen($str) < $min)
        {
            return FALSE;
        }
        return TRUE;
    }
}