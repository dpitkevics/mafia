<?php

namespace core\mvc;

class Module {
    
    /**
     * Moduļa prefikss, lai izmantotu kontrolierus un pārējo iekš paša moduļa
     * @var string 
     */
    protected $modulePrefix = null;
    
    /**
     * Izveido prefiksu un palaiž vēlreiz Loaderu, lai ielādētu kontroleru un pārējās darbības
     * @param string $module Moduļa nosaukums
     * @param string $controller Kontrolera nosaukums
     * @param string $action Darbības nosaukums
     * @param string $static Statiskā skata nosaukums
     * @param array $params Papildus parametri
     */
    public function __construct($module, $controller, $action, $static, $params) {
        $this->modulePrefix = "\\modules\\" . ucfirst($module);
        $loader = new \core\Loader($controller, $action, null, $static, $params, $this->modulePrefix);
    }
    
}

