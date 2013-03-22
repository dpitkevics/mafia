<?php

namespace classes;

class Bool {
    
    public static function isPost() {
        if ($_SERVER['REQUEST_METHOD']==='POST')
            return true;
        return false;
    }
    
}
