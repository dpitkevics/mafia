<?php

namespace classes;

class URL {
    
    public static function create($main, array $params = array()) {
        $url = array();
        if (is_array($main) && !empty($main)) {
            if (count($main) > 1) {
                $url['w'] = $main[0];
                $url['s'] = $main[1];
            } else {
                $url['w'] = $main[0];
            }
        } else if (!is_array($main) && !empty($main)) {
            $url['w'] = $main;
        }
        foreach ($params as $key => $value) {
            $url[$key] = $value;
        }
        $url = URL::decode(URL::buildQuery($url));
        return $url;
    }
    
    public static function buildQuery(array $url) {
        return http_build_query($url);
    } 
    
    public static function decode($url) {
        return urldecode($url);
    }
    
}

