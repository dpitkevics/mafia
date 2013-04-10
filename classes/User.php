<?php

namespace classes;

class User {
    
    public $id;
    public $username;
    public $password;
    public $email;
    public $name;
    public $surname;
    public $age;
    public $refered_by;
    public $session_id;
    public $user_type;
    public $timestamp;
    
    public function __construct($user) {
        $b = \R::findOne('users', ' session_id = :session_id ',
                array(':session_id' => session_id()));
        $this->id = $b->id;
        $this->username = $user->username;
        $this->password = $user->password;
        $this->email = $user->email;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->age = $user->age;
        $this->refered_by = $user->refered_by;
        $this->session_id = $user->session_id;
        $this->user_type = $user->user_type;
        $this->timestamp = $user->timestamp;
    }
    
}

