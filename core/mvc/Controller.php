<?php

namespace core\mvc;

/**
 * Kontroliera klase
 * Izdrukā iegūto kontroliera un skata rezultātu.
 */
class Controller {
    
    /**
     * Kontroliera nosaukums
     * @var string 
     */
    protected $controller;
    /**
     * Layouta nosaukums
     * @var string 
     */
    protected $layout = "main";
    
    /**
     * Nosakam kontroliera nosaukumu
     * @param string $controller Kontroliera nosaukums
     */
    public function __construct($controller) {
        $this->controller = $controller;
    }
    
    /**
     * Izsaucam metodes, kas notiek pirms un pēc darbības izpildīšanas
     * Izsaucam pašu darbību
     * @param string $name Metodes nosaukums - tāds kā lietotāja izveidotajos kontrolieros, bet ar "_" pa priekš
     * @param array $arguments padotie argumenti
     * @return boolean Atgriež FALSE, ja pirms vai pēc darbības nav atgriezts TRUE
     */
    public function __call($name, $arguments) {
        if (!$this->beforeAction())
            return false;
        
        call_user_func_array(array($this, substr($name, 1)), $arguments[0]);
        
        if (!$this->afterAction())
            return false;
    }
    
    /**
     * Metode izsaukta pirms katras darbības, jāatgriež TRUE, lai turpinātu
     * @return boolean True - turpināt, jebkas cits - neturpināt
     */
    protected function beforeAction() {
        return true;
    }
    
    /**
     * Metode izsaukta pēc katras darbības, jāatgriež TRUE, lai turpinātu
     * @return boolean True - turpināt, jebkas cits - neturpināt
     */
    protected function afterAction() {
        return true;
    }
    
    /**
     * Metode izsaukta pirms skata izdrukāšanas uz ekrāna
     * @return boolean True - turpināt, jebkas cits - neturpināt
     */
    protected function beforeDraw() {
        return true;
    }
    
    /**
     * Metode izsaukta pēc skata izdrukāšanas uz ekrāna
     * @return boolean True - turpināt, jebkas cits - neturpināt
     */
    protected function afterDraw() {
        return true;
    }
    
    /**
     * Izdrukā skatu un layoutu
     * @param string $view Skata nosaukums
     * @param array $params Padotie parametri
     * @return boolean Atgriež false, ja nav iziets beforeDraw vai afterDraw.
     */
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

