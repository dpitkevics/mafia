<?php

namespace classes;

class Mover {
    
    public static function Redirect ($url) {
        $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $url;
        header ('Location: ' . $fullUrl);
    }
    
}

