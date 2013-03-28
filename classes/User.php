<?php

namespace classes;

class User {
    
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $name;
    protected $surname;
    protected $age;
    protected $refered_by;
    protected $session_id;
    protected $user_type;
    protected $timestamp;
    
    public function __construct(\RedBean_OODBBean $user) {
        $this->id = $user->id;
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

