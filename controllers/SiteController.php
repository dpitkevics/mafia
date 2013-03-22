<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteController
 *
 * @author danpit134
 */
namespace controllers;

use core\mvc;

class SiteController extends mvc\Controller {
    
    public function actionIndex($b, $c) {
        $test = new \models\Model_Test();
        $test->update();
        
        $this->draw('index', array('b' => $b));
    }
    
}

