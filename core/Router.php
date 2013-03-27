<?php

namespace core;

use core\configs;

/**
 * Sadala URL pa daļām - modulis, kontrolieris, darbība, statiskais skats, pārējie parametri
 */
class Router {
    
    /**
     * Kontroliera nosaukums
     * @var string 
     */
    protected $controller = null;
    /**
     * Darbības nosaukums
     * @var string 
     */
    protected $action = null;
    /**
     * Moduļa nosaukums
     * @var string 
     */
    protected $module = null;
    /**
     * Statiskā skata nosaukums
     * @var string
     */
    protected $static = null;
    /**
     * Padoto parametru masīvs
     * @var array 
     */
    protected $params = array();
    
    /**
     * Sadalam URL parametrus pēc definējuma
     * w - w=([module])/[controller]/[action]
     * s - s=[static_view]
     * ... other GET params
     * @param array $params Padotie parametri
     */
    public function __construct($params) {
        $config = configs\CoreConfig::router();
        
        if ($config['shortUrl']) {
            $url = \classes\URL::shortToParts();
            $this->setData($url['addr'], $url['static'], $url['params']);
            return;
        }
        
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
    
    /**
     * Dod iespēju atgriezt eksistējošus mainīgos, izmantojot metodi
     * @example $this->getController() atgriež mainīgo protected $controller
     * @param string $name Izsauktās metodes nosaukums
     * @param array $arguments Padotie papildus parametri (šeit tādi nav izmantoti)
     * @return null|boolean|string Atgriež null, ja nav atrasts mainīgais,
     * false, ja nav izsaukta "get" metode,
     * pašu mainīgo, ja viss ir kārtībā
     */
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
    
    /**
     * Pārbauda visas config failā norādītās vērtības,
     * saliek visas iegūtās vērtības
     * @param string $addr Neapstrādāta adrese
     * @param string $static Statiskā skata nosaukums
     * @param array $params Padotie papildus parametri
     */
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

