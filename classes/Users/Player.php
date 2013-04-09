<?php

namespace classes\Users;

class Player extends \classes\User {
    
    public $energy_level;
    public $energy_max;
    public $energy_update_timestamp;
    public $energy_update_amount;
    
    public $current_hp;
    public $hp_update_timestamp;
    
    public $char_max_hp;
    public $char_hp_recovery_time;
    public $char_hp_recovery_amount;
    public $char_type;
    public $char_name;
    
    public $char_exp;
    public $char_level;
    public $char_title;
    public $char_next_level_xp;
    
    public function __construct($user) {
        parent::__construct($user);
        
        $this->energy_level = $user->energy_level;
        $this->energy_max = $user->energy_max;
        $this->energy_update_timestamp = $user->energy_update_timestamp;
        $this->energy_update_amount = $user->energy_update_amount;
        $this->current_hp = $user->current_hp;
        $this->hp_update_timestamp = $user->hp_update_timestamp;
        $this->char_max_hp = $user->char_max_hp;
        $this->char_hp_recovery_time = $user->char_hp_recovery_time;
        $this->char_hp_recovery_amount = $user->char_hp_recovery_amount;
        $this->char_type = $user->char_type;
        $this->char_name = $user->char_name;
        $this->char_exp = $user->char_exp;
        
        $leveling = Helper::getCharLevelData($this->char_exp);
        $this->char_level = $leveling->level;
        $this->char_title = $leveling->title;
        $this->char_next_level_xp = $leveling->exp_to + 1;
    }
    
}
