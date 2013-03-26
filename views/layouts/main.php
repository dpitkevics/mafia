<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Testing</title>
        <meta charset="utf8">

        <link rel="stylesheet" href="<?=ROOT_HOST;?>/css/bootstrap.css" />
    </head>
    <body>
        
        <div class="container">
            
            <div class="row">
                
                <?php if (!$this->auth->checkAuth()): ?>
                
                <?=classes\Html::formBegin();?>
                
                <div class="span3">
                    <?=classes\Html::textField('username', '', array('placeholder' => 'Username'));?>
                </div>
                
                <div class="span3">
                    <?=classes\Html::passwordField('password', '', array('placeholder' => 'Password'));?>
                </div>
                
                <div class="span2">
                    <?=classes\Html::submitButton('Login', array('class' => 'btn btn-primary'));?>
                </div>
                
                <?=classes\Html::hiddenField('login');?>
                <?=classes\Html::formEnd();?>
                
                <?php else: ?>
                
                <?=classes\Html::link('Logout', \classes\URL::create('site/logout'), array('class' => 'btn btn-primary'));?>
                
                <?php endif; ?>
                
            </div>
            
            <div class="row">
                
                <?=$content;?>
                
            </div>
            
        </div>
        
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="<?=ROOT_HOST;?>js/bootstrap.min.js"></script>
    </body>
</html>