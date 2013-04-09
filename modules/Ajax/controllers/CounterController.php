<?php

namespace modules\Ajax\controllers;

class CounterController extends \myclasses\AjaxController {
    
    public function actionHp() {
        $timeTillHpUpdate = ($this->user->char_hp_recovery_time - (time()-$this->user->hp_update_timestamp));
        if ($timeTillHpUpdate <= 0 && $this->user->current_hp != 100)
            $this->updateHp();
        $this->drawPartial('hp');
    }
    
    public function updateHp() {
        $amountPercentage = (100 / $this->user->char_max_hp) * $this->user->char_hp_recovery_amount;
        $this->user->current_hp += $amountPercentage;
        if ($this->user->current_hp > 100)
            $this->user->current_hp = 100;
        $this->user->hp_update_timestamp = time();
        $user = \R::findOne('user_chars', ' user_id = :user_id ',
                array (':user_id' => $this->user->id));
        $user->current_hp = $this->user->current_hp;
        $user->hp_update_timestamp = $this->user->hp_update_timestamp;
        \R::store($user);
        
        return;
    }
    
    public function actionEnergy() {
        $timeTillEnergyUpdate = (ENERGY_UPDATE_TIME - (time()-$this->user->energy_update_timestamp));
        if ($timeTillEnergyUpdate <= 0 && $this->user->energy_level != 100)
            $this->updateEnergy();
        $this->drawPartial('energy');
    }
    
    public function updateEnergy() {
        $amountPercentage = (100 / $this->user->energy_max) * $this->user->energy_update_amount;
        $this->user->energy_level += $amountPercentage;
        if ($this->user->energy_level > 100)
            $this->user->energy_level = 100;
        $this->user->energy_update_timestamp = time();
        $user = \R::findOne('user_energies', ' user_id = :user_id ',
                array (':user_id' => $this->user->id));
        $user->energy_level = $this->user->energy_level;
        $user->energy_update_timestamp = $this->user->energy_update_timestamp;
        \R::store($user);
        
        return;
    }
    
}
