<?php

namespace classes\Users;

class Player extends \classes\User {
    
    protected $energy_level;
    protected $energy_max;
    protected $energy_update_timestamp;
    
    protected $current_hp;
    protected $hp_update_timestamp;
    
    protected $char_max_hp;
    protected $char_hp_recovery_time;
    protected $char_hp_recovery_amount;
    protected $char_type;
    protected $char_name;
    
}
