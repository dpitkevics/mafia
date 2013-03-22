<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author danpit134
 */
namespace core\mvc;

class Controller {
    
    protected $controller;
    protected $layout = "main";
    
    public function __construct($controller) {
        $this->controller = $controller;
    }
    
    public function __call($name, $arguments) {
        if (!$this->beforeAction())
            return false;
        
        call_user_func_array(array($this, substr($name, 1)), $arguments[0]);
        
        if (!$this->afterAction())
            return false;
    }
    
    protected function beforeAction() {
        return true;
    }
    
    protected function afterAction() {
        return true;
    }
    
    protected function beforeDraw() {
        return true;
    }
    
    protected function afterDraw() {
        return true;
    }
    
    protected function draw($view, array $params = array()) {
        $path = ROOT_DIR . "views/" . $this->controller . "/" . $view . ".php";
        
        extract ($params);
        ob_start();
        include $path;
        $content = ob_get_clean();
        
        $path = ROOT_DIR . "views/layouts/" . $this->layout . ".php";
        ob_start();
        include $path;
        $output = ob_get_clean();
        
        if (!$this->beforeDraw())
            return false;
        
        echo $output;
        
        if (!$this->afterDraw())
            return false;
    }
    
}

