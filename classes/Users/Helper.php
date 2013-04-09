<?php

namespace classes\Users;

class Helper {
    
    public static function getCharClassFromId($id) {
        $char = \R::findOne('chars', $id);
        return $char->char_name;
    }
    
    public static function arrToObj($arr) {
        $object = new \stdClass();
        foreach ($arr as $key => $value) {
            $object->$key = $value;
        }
        return $object;
    }
    
    public static function getCharLevelData($exp) {
        $char_levels = \R::findOne('char_leveling', ' :exp >= exp_from AND :exp <= exp_to ',
                array(':exp' => $exp));
        return $char_levels;
    }
    
}
