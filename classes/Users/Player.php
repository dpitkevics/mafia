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
    public $char_this_level_xp;
    
    public $melee_damage;
    public $distance_damage;
    public $melee_resistance;
    public $distance_resistance;
    public $special_damage;
    public $ultimate_damage;
    public $building_speed;
    public $building_energy_multiplicator;
    
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
        $this->char_level = $user->level;
        $this->char_title = $user->title;
        $this->char_next_level_xp = $user->exp_to + 1;
        $this->char_this_level_xp = $user->exp_from;
        
        
        $this->melee_damage = $user->melee_damage + ($this->char_level * $user->melee_damage_point);
        $this->distance_damage = $user->distance_damage + ($this->char_level * $user->distance_damage_point);
        $this->melee_resistance = $user->melee_resistance + ($this->char_level * $user->melee_resistance_point);
        $this->distance_resistance = $user->distance_resistance + ($this->char_level * $user->distance_resistance_point);
        $this->special_damage = $user->special_damage;
        $this->ultimate_damage = $user->ultimate_damage;
        $this->building_speed = $user->building_speed + ($this->char_level * $user->building_speed_point);
        $this->building_energy_multiplicator = $user->building_energy_multiplicator;
    }
    
}
