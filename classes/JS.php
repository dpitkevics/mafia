<?php

namespace classes;

class JS {
    
    public static $jss = array();
    
    public static function ajaxCall($url, array $data = array(), array $params = array(), $event = '', $id = 'al0', $type = 'POST') {
        $glob['url'] = $url;
        $glob['data'] = $data;
        $glob['type'] = $type;
        
        foreach ($params as $key => $value) {
            $glob[$key] = $value;
        }

        $value_arr = array();
        $replace_keys = array();
        foreach($glob as $key => &$value){
            if (is_array($value)) continue;
            if(strpos($value, 'function(')!==false || strpos($value, 'function (')!==false){
                $value_arr[] = $value;
                $value = '%' . $key . '%';
                $replace_keys[] = '"' . $value . '"';
            }
        }
        
        $json = self::arrayToJson($glob);
        $json = str_replace($replace_keys, $value_arr, $json);
        
        $js = "$.ajax(";
        $js .= $json;
        $js .= ");";
        if ($event != '')
            self::$jss[$event][$id] = $js;
        
        return $js;
    }
    
    public static function arrayToJson(array $array = array()) {
        return json_encode($array);
    }
    
    public static function scriptStart() {
        return "<script type='text/javascript'>$(function() { " . PHP_EOL;
    }
    
    public static function scriptEnd() {
        return "});</script>";
    }
    
}
