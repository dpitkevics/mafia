<?php

namespace core;

/**
 * Galvenā klase, tiek izmantota, lai uztaisītu aplikācijas objektu.
 * Palaiž visu, kas nepieciešams lapas izveidei
 */
class Base {
    
    /**
     * Konstruktors reģistrē autoload funkciju
     * un ielādē visus paplašinājumus
     */
    public function __construct() {
        spl_autoload_register(array($this, 'autoload'));
        $this->loadExtensions();
    }
    
    /**
     * Izveido savienojumu ar ORM datubāzi
     * No URL iegūst datus
     * Ielādē nepieciešamos kontrolierus un moduļus un darbības
     */
    public function Run() {
        \classes\Session::startSession();
        
        $db = configs\CoreConfig::db();
        \R::setup($db['string'],$db['user'],$db['pass']);
        
        $router = new Router(\classes\Validator::Get());
        $loader = new Loader($router->getController(), $router->getAction(), $router->getModule(), $router->getStatic(), $router->getParams());
    }
    
    /**
     * Autoload funkcija - izmanto namespace, lai atrastu, ko un kur vajag
     * @param string $class Automātiski padotā izmantotā klase
     */
    private function autoload($class) {
        $classFile = str_replace( '\\', DIRECTORY_SEPARATOR, $class );
        $classPI = pathinfo( $classFile );
        $classPath = $classPI[ 'dirname' ];

        if (is_file(ROOT_DIR . $classPath . DIRECTORY_SEPARATOR . $classPI[ 'filename' ] . '.php'))
            include_once( ROOT_DIR . $classPath . DIRECTORY_SEPARATOR . $classPI[ 'filename' ] . '.php' ); 
    }
    
    /**
     * Ielādē paplašinājumus pēc Config failā atrodamajiem
     */
    private function loadExtensions() {
        foreach (configs\CoreConfig::extensions() as $extensionName => $extension) {
            foreach ($extension['subclasses'] as $subclass) {
                include_once ROOT_DIR . 'extensions/' . $extensionName . '/' . $subclass . '.php';
            }
            include_once ROOT_DIR . 'extensions/' . $extensionName . '/' . $extension['class'] . '.php';
        }
    }
    
}

