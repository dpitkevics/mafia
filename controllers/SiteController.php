<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteController
 *
 * @author danpit134
 */
namespace controllers;

class SiteController extends \myclasses\BaseController {
          
    public function actionIndex() {
        $auth = new \classes\Authentication();            
        
        $this->draw('index', array('isUser' => $auth->checkAuth()));
    }
    
    public function actionTest() {
        $this->draw('test');
    }
    
    public function actionLogin() {
        if (\classes\Bool::isPost()) {
            $post = \classes\Validator::EncodeArray($_POST);
            $auth = new \classes\Authentication();
            $auth->setAuthenticationData($post);
            
            $user = $auth->findAuth();
            
            if ($user) {
                $auth->setAuth ($user);
                \classes\Mover::Redirect(\classes\URL::create('site/index'));
            } else
                echo 'Wrong authentication data';
        }
        $this->draw('login');
    }
    
    public function actionLogout() {
        $auth = new \classes\Authentication();
        if ($auth->checkAuth())
            $auth->removeAuth ();
        \classes\Session::deleteAllSessions();
        \classes\Mover::Redirect(\classes\URL::create('site/index'));
    }
    
}

