<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Module
 *
 * @author danpit134
 */
namespace core\mvc;

class Module {
    
    protected $modulePrefix = null;
    
    public function __construct($module, $controller, $action, $static, $params) {
        $this->modulePrefix = "\\modules\\" . ucfirst($module);
        $loader = new \core\Loader($controller, $action, null, $static, $params, $this->modulePrefix);
    }
    
}

