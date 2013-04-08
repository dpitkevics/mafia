<?php

namespace classes;

class Session {
    
    public static function startSession() {
        if (session_id() == '')
            session_start();            
    }
    
    public static function createSession($name, $value) {
        $name = Validator::Encode($name);
        if (is_array($value))
            $value = Validator::EncodeArray ($value);
        else
            $value = Validator::Encode ($value);
        $_SESSION[$name] = $value;
    }
    
    public static function getSession($name) {
        $name = Validator::Encode($name);
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            return null;
    }
    
    public static function deleteSession($name) {
        $name = Validator::Encode($name);
        if (isset($_SESSION[$name]))
            unset ($_SESSION[$name]);
        return true;
    }
    
    public static function deleteAllSessions() {
        session_unset();
        session_destroy();
        return true;
    }
    
}

