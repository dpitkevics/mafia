<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author danpit134
 */
namespace classes;

class Validator {
    
    public static function Get() {
        $g = $_GET;
        if (is_array($g) && !empty($g))
            return self::EncodeArray($_GET);
        else if (is_array($g))
            return array();
        else if (!is_array($g) && $g)
            return self::Encode ($g);
        else
            return null;
    }
    
    public static function Encode ($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    
    public static function EncodeArray(array $data) {
        $d = array();
        foreach ($data as $key => $value) {
            if (is_string($key))
                $key = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            if (is_string($value))
                $value = htmlspecialchars ($value, ENT_QUOTES, 'UTF-8');
            else if (is_array($value))
                $value = self::EncodeArray ($value);
            $d[$key] = $value;
        }
        return $d;
    }
    
}

