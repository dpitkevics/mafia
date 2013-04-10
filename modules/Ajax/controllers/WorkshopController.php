<?php

namespace modules\Ajax\controllers;

class WorkshopController extends \myclasses\AjaxController {
    
    public function actionXp() {
        $post = \classes\Validator::EncodeArray($_POST);
        if (!isset($post['exp']) || !isset($post['energy']))
            return false;
        $amountPercentage = (100 / $this->user->energy_max) * $post['energy'];
        $this->user->energy_level -= $amountPercentage;
        $this->user->char_exp += $post['exp'];
        $user = \R::findOne('user_energies', ' user_id = :user_id ',
                array (':user_id' => $this->user->id));
        $user->energy_level = $this->user->energy_level;
        $char_user = \R::findOne('user_chars', ' user_id = :user_id ',
                array (':user_id' => $this->user->id));
        $char_user->char_exp = $this->user->char_exp;
        \R::store($user);
        \R::store($char_user);
        
        $this->drawPartial('xp');
    }
    
}
