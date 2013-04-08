<?php

namespace models;

use core\mvc;

class Model_Users extends mvc\Model {
    
    public $model = 'Users';
    public $table = 'users';
    
    public function rules() {
        return array(
            'username, password, password_ver, email' => 'required',
            'password, password_ver' => 'identical',
            'email' => 'email',
            'age, referal' => 'int'
        );
    }
    
    public function attributes() {
        return array(
            'username' => 'Username',
            'password' => 'Password',
            'password_ver' => 'Password verification',
            'email' => 'E-mail',
            'name' => 'Name',
            'surname' => 'Surname',
            'age' => 'Age',
            'refered_by' => 'Refered by',
        );
    }
        
}

