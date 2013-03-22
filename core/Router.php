<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author danpit134
 */
namespace core;

use core\configs;

class Router {
    
    protected $controller = null;
    protected $action = null;
    protected $module = null;
    protected $static = null;
    protected $params = array();
    
    public function __construct($params) {
        if (isset($params['w']) && !empty($params['w'])) {
            $addr = $params['w'];
            unset ($params['w']);
        } else  {
            $addr = null;
        }
        
        if (isset($params['s']) && !empty($params['s'])) {
            $static = $params['s'];
            unset ($params['s']);
        } else {
            $static = null;
        }
        
        $this->setData($addr, $static, $params);
    }
    
    public function __call($name, $arguments) {
        if (substr($name, 0, 3)=="get") {
            $name = strtolower(substr($name, 3));
            if (isset($this->$name))
                return $this->$name;
            else
                return null;
        }
        return false;
    }
    
    private function setData($addr = null, $static = null, $params = array()) {
        $routerDefaults = configs\CoreConfig::router();
        if ($addr === null) {
            if (isset($routerDefaults['controller']))
                $this->controller = $routerDefaults['controller'];
            else
                $this->controller = 'default';
            
            if (isset($routerDefaults['action']))
                $this->action = $routerDefaults['action'];
            else
                $this->action = 'index';
            
            if (isset($routerDefaults['module']))
                $this->module = $routerDefaults['module'];
        } else {
            if (strpos($addr, '/') !== false) {
                $parts = explode('/', $addr);
                
                if (count ($parts) > 2) {
                    $this->module = $parts[0];
                    array_shift($parts);
                }
                
                foreach ($parts as $part) {
                    if ($this->controller === null)
                        $this->controller = $part;
                    else if ($this->action === null)
                        $this->action = $part;
                    else
                        break;
                }
            } else {
                $this->controller = $addr;
                $this->action = 'index';
            }
        }
        
        if ($static === null) {
            if (isset($routerDefaults['static']))
                $this->static = $routerDefaults['static'];
        } else {
            $this->static = $static;
        }
        
        if (empty($params)) {
            if (isset($routerDefaults['params']) && is_array($routerDefaults['params']))
                $this->params = $routerDefaults['params'];
        } else {
            $this->params = $params;
        }
    }
    
}

