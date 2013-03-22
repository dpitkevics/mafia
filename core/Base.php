<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base
 *
 * @author danpit134
 */
namespace core;

class Base {
    
    public function __construct() {
        spl_autoload_register(array($this, 'autoload'));
        $this->loadExtensions();
    }
    
    public function Run() {
        \R::setup('mysql:host=localhost;dbname=maf','root','');
        $router = new Router(\classes\Validator::Get());
        $loader = new Loader($router->getController(), $router->getAction(), $router->getModule(), $router->getStatic(), $router->getParams());
    }
    
    private function autoload($class) {
        $classFile = str_replace( '\\', DIRECTORY_SEPARATOR, $class );
        $classPI = pathinfo( $classFile );
        $classPath = strtolower( $classPI[ 'dirname' ] );

        if (is_file($classPath . DIRECTORY_SEPARATOR . $classPI[ 'filename' ] . '.php'))
            include_once( $classPath . DIRECTORY_SEPARATOR . $classPI[ 'filename' ] . '.php' ); 
    }
    
    private function loadExtensions() {
        foreach (configs\CoreConfig::extensions() as $extensionName => $extension) {
            foreach ($extension['subclasses'] as $subclass) {
                include_once ROOT_DIR . 'extensions/' . $extensionName . '/' . $subclass . '.php';
            }
            include_once ROOT_DIR . 'extensions/' . $extensionName . '/' . $extension['class'] . '.php';
        }
    }
    
}

