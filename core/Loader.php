<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loader
 *
 * @author danpit134
 */
namespace core;

class Loader {
       
    protected $_iOfController = null;
    protected $_iOfModule = null;
    
    protected $_prefix = "";
    
    public function __construct($controller, $action, $module = null, $static = null, $params = array(), $prefix = "") {
        $this->_prefix = $prefix;
        if ($module !== null)
            $this->loadModule($module, $controller, $action, $static, $params);
        else {
            $this->loadController($controller);
            $this->loadAction($action, $params);
        }
    }
    
    protected function loadModule($module, $controller, $action, $static, $params) {
        $moduleString = "\\modules\\" . ucfirst($module) . "\\" . ucfirst($module) . "Module";
        $this->_iOfModule = new $moduleString($module, $controller, $action, $static, $params);
        return $this->_iOfModule;
    }
    
    protected function loadController($controller) {
        $controllerString = $this->_prefix . "\\controllers\\" . ucfirst($controller) . "Controller";
        $this->_iOfController = new $controllerString($controller);
        return $this->_iOfController;
    }
    
    protected function loadAction($action, $params = array()) {
        if ($this->_iOfController === null)
            return false;
        $actionString = "_action" . ucfirst($action);
        $this->_iOfController->$actionString($params);
    }
    
}

