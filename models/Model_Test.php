<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_Test
 *
 * @author danpit134
 */
namespace models;

class Model_Test extends \RedBean_SimpleModel {
    
    public $table = 'test';
    
    public function update() {
        $test = \R::load($this->table, 1);
        $test->name = 'new2';
        $test->ts = time();
        \R::store($test);
    }
            
}
