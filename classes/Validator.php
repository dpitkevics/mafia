<?php

namespace classes;


/**
 * Klase Validator saturēs visas statiskas metodes
 * Paredzēts, lai validētu datus
 * Metodes tiks liktas klāt pēc nepieciešamības
 * 
 * @version 1.0
 * @author Daniels Pitkevičs <daniels.pitkevics@gmail.com>
 */
class Validator {
    
    /**
     * Validē Get parametrus visus.
     * @return mixed Validētus masīvu, ja ir dati,
     * tukšu masīvu, ja nav dati
     * stringu, ja nav padots masīvs (nenotiks)
     */
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
    
    /**
     * Validē stringu
     * @param string $string Teksta gabals, kuru validēt
     * @return string Validēts teksts
     */
    public static function Encode ($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Validē masīvu
     * @param array $data Nevalidēts masīvs
     * @return array Validēts masīvs
     */
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

