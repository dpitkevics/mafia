<?php

namespace core\configs;

/**
 * Satur nepieciešamos konfigus, kuri tiek ik pa laikam izsaukti
 * Visas metodes ir statiskas, lai viegli tikt klāt un nav nepieciešami objekti
 */
class CoreConfig {
    
    /**
     * Defaultie Routing uzstādījumi
     * @return array default routing
     */
    public static function router() {
        return array(
            'controller' => 'site',
            'action' => 'index',
        );
    }
    
    /**
     * Papildus paplašinājumi
     * @return array paplašinājumu saraksts
     */
    public static function extensions() {
        return array(
            'rb' => array(
                'class' => 'r',
                'subclasses' => array(
                ),
            )
        );
    }
    
    public static function db() {
        return array(
            'string' => 'mysql:host=localhost;dbname=maf',
            'user' => 'root',
            'pass' => '',
        );
    }
    
}

