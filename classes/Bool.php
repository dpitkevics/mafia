<?php

namespace classes;

class Bool {
    
    public static function isPost() {
        if ($_SERVER['REQUEST_METHOD']==='POST')
            return true;
        return false;
    }
    
    public static function isAjax() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return true;
        return false;
    }
    
}
