<?php

namespace core;

/**
 * Klase, kas ielādē nepieciešamo moduli, kontrolieru, darbību utt
 */
class Loader {
       
    /**
     * Kontroliera instance
     * @var Controller 
     */
    protected $_iOfController = null;
    /**
     * Moduļa instance
     * @var Module
     */
    protected $_iOfModule = null;
    
    /**
     * Prefikss
     * @var string 
     */
    protected $_prefix = "";
    
    /**
     * Ielādē nepieciešamo - pārbauda uz moduļiem
     * @param string $controller Kontroliera nosaukums
     * @param string $action Darbības nosaukums
     * @param string $module Moduļa nosaukums
     * @param string $static Statiskā skata nosaukums
     * @param array $params Pārējo GET parametru masīvs
     * @param string $prefix Prefikss
     */
    public function __construct($controller, $action, $module = null, $static = null, $params = array(), $prefix = "") {
        $this->_prefix = $prefix;
        if ($module !== null)
            $this->loadModule($module, $controller, $action, $static, $params);
        else {
            $this->loadController($controller);
            $this->loadAction($action, $params);
        }
    }
    
    /**
     * Moduļa ielāde, ja nepieciešams
     * @param string $module Moduļa nosaukums
     * @param string $controller Kontroliera nosaukums
     * @param string $action Darbības nosaukums
     * @param string $static Statiskā skata nosaukums
     * @param array $params Atlikušo GET parametru masīvs
     * @return Module Iegūtā Moduļa instance
     */
    protected function loadModule($module, $controller, $action, $static, $params) {
        $moduleString = "\\modules\\" . ucfirst($module) . "\\" . ucfirst($module) . "Module";
        $this->_iOfModule = new $moduleString($module, $controller, $action, $static, $params);
        return $this->_iOfModule;
    }
    
    /**
     * Ielādē kontrolieri
     * @param string $controller Kontroliera nosaukums
     * @return Controller Iegūtā Kontroliera instance
     */
    protected function loadController($controller) {
        $controllerString = $this->_prefix . "\\controllers\\" . ucfirst($controller) . "Controller";
        $this->_iOfController = new $controllerString($controller, $this->_prefix);
        return $this->_iOfController;
    }
    
    /**
     * Izpilda darbību
     * @param string $action Darbības nosaukums
     * @param array $params GET parametri
     * @return boolean Atgriež FALSE, ja nav norādīts kontrolieris
     */
    protected function loadAction($action, $params = array()) {
        if ($this->_iOfController === null)
            return false;
        $actionString = "_action" . ucfirst($action);
        $this->_iOfController->$actionString($params);
    }
    
}

