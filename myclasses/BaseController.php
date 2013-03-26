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
                $auth->setAuthenticationData($post);
                
                $found = $auth->findAuth();
                if ($found) {
                    $auth->setAuth ($found);
                    \classes\Mover::Redirect(\classes\URL::create('site/index'));
                } else {
                    echo 'Wrong auth data';
                }
            }
        } 
        
        /*
        if (!$auth->checkAuth()) {
            $this->draw('off.login');
            return false;
        }
         */
        return true;
    }
    
}

