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
namespace modules\Demo\controllers;

use core\mvc;

class SiteController extends mvc\Controller {
    public function actionIndex($b) {
        var_dump ("module: " . $b);
    }
}

