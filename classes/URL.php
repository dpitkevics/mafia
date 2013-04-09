<?php

namespace classes;

class URL {
    
    public static function create($main, array $params = array()) {
        $config = \core\configs\CoreConfig::router();
        if (!$config['shortUrl']) {
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
            $url = ((strpos($url,'?')===false)?'?':'') . $url;
        } else {
            $url = ROOT_HOST . '/' . $main;
            foreach ($params as $key => $value) {
                $url .= "/$key/$value";
            }
        }
        return $url;
    }
    
    public static function buildQuery(array $url) {
        return http_build_query($url);
    } 
    
    public static function decode($url) {
        return urldecode($url);
    }
    
    public static function shortToParts() {
        $get = Validator::Get();
        if (isset($get['url']))
            $url = $get['url'];
        else {
            $config = \core\configs\CoreConfig::router();
            $url = $config['controller'] . '/' . $config['action'];
        }
        $urlParts = explode('/', $url);
        $result = '';
        if (count($urlParts)!=1) {
            if (count($urlParts)%2 == 1) {
                $result .= $urlParts[0] . '/';
                array_shift($urlParts);
            }
            $result .= $urlParts[0] . '/';
            array_shift($urlParts);
            $result .= $urlParts[0];
            array_shift($urlParts);
        } else {
            $result = $urlParts[0];
            array_shift($urlParts);
        }
        $urlFinal['addr'] = $result;
        $urlFinal['static'] = null;
        $urlFinal['params'] = array();
        if (isset($urlParts) && is_array($urlParts)) {
            for ($i = 0; $i < sizeof($urlParts); $i++) {
                $urlFinal['params'][$urlParts[$i]] = $urlParts[++$i];
            }
        }
        return $urlFinal;
    }
    
    public static function getUrlPart($part) {
        $urlParts = self::shortToParts();
        if (isset($urlParts[$part]))
            return $urlParts[$part];
        else if (array_key_exists($part, $urlParts['params']))
            return $urlParts['params'][$part];
        return null;
    }
    
}

