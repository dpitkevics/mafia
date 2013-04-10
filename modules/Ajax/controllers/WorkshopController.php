<?php

namespace modules\Ajax\controllers;

class WorkshopController extends \myclasses\AjaxController {
    
    public function actionXp() {
        $post = \classes\Validator::EncodeArray($_POST);
        if (!isset($post['exp']) || !isset($post['energy']))
            return false;
        
        $amountPercentage = (100 / $this->user->energy_max) * $post['energy'];
        $this->user->energy_level -= $amountPercentage;
        $extra = '';
        
        if ($this->user->energy_level < 0)
            $extra .= "<script>alert('No more energy left');</script>";
        else {
            $this->user->char_exp += $post['exp'];
            if ($this->user->char_exp >= $this->user->char_next_level_xp) {
                $diff = $this->user->char_exp - $this->user->char_next_level_xp;
                $this->user->char_exp = $diff;
                $this->user->char_level++;
                $extra .= "<script>";
                $extra .= \classes\JS::ajaxCall(
                        \classes\URL::create('ajax/workshop/char'), 
                        array(),
                        array(
                            'success' => 'function (html) { $(".char-box").html(html); }'
                        )
                );
                $extra .= "</script>";
            }
            $user = \R::findOne('user_energies', ' user_id = :user_id ',
                    array (':user_id' => $this->user->id));
            $user->energy_level = $this->user->energy_level;
            $char_user = \R::findOne('user_chars', ' user_id = :user_id ',
                    array (':user_id' => $this->user->id));
            $char_user->char_exp = $this->user->char_exp;
            $char_user->char_level = $this->user->char_level;
            \R::store($user);
            \R::store($char_user);

            $levels = \R::findOne('char_leveling', ' level = :level ',
                    array(':level' => $this->user->char_level));
            $this->user->char_title = $levels->title;
        }
        
        $this->drawPartial('xp', array('extra' => $extra));
    }
    
    public function actionChar() {
        $this->drawPartial('char');
    }
    
}
