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
        $isUser = $auth->checkAuth();

        $this->draw('index', array('isUser' => $isUser));
    }
    
    public function actionRegistration() {
        $model = new \models\Model_Users();
        
        if (\classes\Bool::isPost()) {
            $post = \classes\Validator::EncodeArray($_POST);
            $model->data = $post[$model->model];
            if (!$model->validate())
                $this->errors = $model->errors;
            else {
                $model->data['password'] = sha1($model->data['password']);
                $model->data['timestamp'] = time();
                unset($model->data['password_ver']);
                $model->save();
                \classes\Mover::Redirect(\classes\URL::create('site/regComplete'));
            }
        }
        
        $this->draw('registration', array('model' => $model));
    }
    
    public function actionRegComplete() {
        $this->draw('off.complete', array(
            'name' => 'Registration',
            'alt' => 'Check Your email for confirmation.'
        ));
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

