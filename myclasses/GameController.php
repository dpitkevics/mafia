<?php

namespace myclasses;

use core\mvc;

class GameController extends mvc\Controller {
    
    public $auth;
    public $user;
    
    
    public function beforeAction() {
        $auth = new \classes\Authentication();
        $this->auth = $auth;
        
        if (!$this->auth->checkAuth()) {
            \classes\Mover::Redirect(\classes\URL::create('site/index'));
        } else {
            $user_char = \R::$f->begin()->select('*')
                               ->from('user_chars')
                               ->join('chars')
                               ->on('user_chars.char_id = chars.id')
                               ->join('user_energies')
                               ->on('user_chars.user_id = user_energies.user_id')
                               ->join('users')
                               ->on('user_chars.user_id = users.id')
                               ->join('char_points')
                               ->on('user_chars.char_id = char_points.char_id')
                               ->where('user_chars.user_id = ?')
                               ->put($this->auth->user->id)
                               ->get('row');

            $charClass = \classes\Users\Helper::getCharClassFromId($user_char['char_id']);
            $charClass = "\\classes\\Users\\PlayerTypes\\" . $charClass;
            
            $user_char = \classes\Users\Helper::arrToObj($user_char);
            $char = new $charClass($user_char);
            $this->user = $char;
        }

        return true;
    }
    
}

