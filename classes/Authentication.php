<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Authentication
 *
 * @author danpit134
 */
namespace classes;

class Authentication {
    
    protected $authFields = array(
        'username',
        'password',
    );
    
    protected $authData = array();
    
    protected $authTable = 'users';
    
    public $user = null;
    
    public function setAuthenticationFields(array $fields) {
        if (!empty($fields))
            $this->authFields = $fields;
        else
            return false;
    }
    
    public function setAuthenticationData(array $data) {
        if (empty($data))
            return false;
        foreach ($data as $key => $value) {
            if (in_array($key, $this->authFields))
                $this->authData[$key] = $value;
        }
    }
    
    public function setAuthTable($table) {
        if (strlen($table)>0)
            $this->authTable = $table;
        else
            return false;
    }
    
    public function findAuth() {
        $searchString = ' ';
        $data = array();
        foreach ($this->authData as $field => $value) {
            $searchString .= $field . ' = :' . $field . ' AND ';
            $data[':' . $field] = $value;
        }
        $searchString = rtrim($searchString, ' AND ');
        $user = \R::findOne($this->authTable, $searchString, $data);
        return $user;
    }
    
    public function setAuth(\RedBean_OODBBean $user) {
        $user->session_id = session_id();
        \R::store($user);
        return true;
    }
    
    public function checkAuth() {
        $user = \R::findOne($this->authTable, ' session_id = :session_id', array(':session_id' => session_id()));
        if ($user) {
            $this->user = $user;
            return true;
        }
        return false;
    }
    
    public function removeAuth() {
        $user = \R::findOne($this->authTable, ' session_id = :session_id', array(':session_id' => session_id()));
        if ($user) {
            $user->session_id = time();
            \R::store($user);
        }
        return true;
    }
    
}

