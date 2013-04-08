<?php

namespace classes;

class Mover {
    
    public static function Redirect ($url) {
        $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] .  $url;
        header ('Location: ' . $fullUrl);
    }
    
}

