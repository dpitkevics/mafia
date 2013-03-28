<?php

namespace modules\Game\controllers;

class CharacterController extends \myclasses\GameController {
    
    public function actionList() {
        $this->draw('list', array('user'=>$this->user));
    }
    
}
