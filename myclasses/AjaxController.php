<?php

namespace myclasses;

class AjaxController extends GameController {
    public function beforeAction() {
        if (!\classes\Bool::isAjax())
            return false;
        return parent::beforeAction();
    }
}

