<?php

namespace modules\Game\controllers;

class WorkshopController extends \myclasses\GameController {
    
    public function actionIndex() {
        $this->draw('index');
    }
    
}
