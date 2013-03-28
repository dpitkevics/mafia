<?php

namespace myclasses;

use core\mvc;

class BaseController extends mvc\Controller {
    
    public $auth;
    public $player;
    
    public function beforeAction() {
        $auth = new \classes\Authentication();
        $this->auth = $auth;
        
        if (!$this->auth->checkAuth()) {
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
        } else {
            $user_char = \R::$f->begin()->select('*')
                               ->from('user_chars')
                               ->join('chars')
                               ->on('user_chars.char_id = chars.id')
                               ->where('user_chars.user_id = ?')
                               ->put($this->auth->user->id)
                               ->get('row');
            \classes\Dump::r($user_char);
        }

        return true;
    }
    
}

