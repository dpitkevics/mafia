<?php

namespace myclasses;

use core\mvc;

class BaseController extends mvc\Controller {
    
    public $auth;
    
    public function beforeAction() {
        $auth = new \classes\Authentication();
        $this->auth = $auth;
        
        if (\classes\Bool::isPost()) {
            $post = \classes\Validator::EncodeArray($_POST);
            if (isset($post['login'])) {
                $post['password'] = sha1($post['password']);
                $auth->setAuthenticationData($post);
                
                $found = $auth->findAuth();
                if ($found) {
                    $auth->setAuth ($found);
                    \classes\Mover::Redirect(\classes\URL::create('site/index'));
                } else {
                    $this->errors['login'][] = "<p>Wrong authentication data.</p>";
                }
            }
        } 

        return true;
    }
    
}

