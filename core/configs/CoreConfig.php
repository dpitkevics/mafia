<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreConfig
 *
 * @author danpit134
 */
namespace core\configs;

class CoreConfig {
    
    public static function router() {
        return array(
            'controller' => 'default',
            'action' => 'index',
        );
    }
    
    public static function extensions() {
        return array(
            'rb' => array(
                'class' => 'r',
                'subclasses' => array(
                ),
            )
        );
    }
    
}

