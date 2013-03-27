<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Testing</title>
        <meta charset="utf8">

        <link rel="stylesheet" href="<?=ROOT_HOST;?>/css/bootstrap.css" />
        <link rel="stylesheet" href="<?=ROOT_HOST;?>/css/main.css" />
    </head>
    <body>
        
        <div class="container">
            
            <div class="row">

                <?=classes\Html::unorderedList(
                    array(
                        array(
                            'link' => array(
                                'name' => 'Home',
                                'url' => \classes\URL::create('site/index'),
                            ),
                            'htmlOptions' => array(
                                'class' => 'active',
                            )
                        ),
                        array(
                            'link' => array(
                                'name' => 'About',
                                'url' => \classes\URL::create('site/about'),
                            ),
                        ),
                        array(
                            'link' => array(
                                'name' => 'Contacts',
                                'url' => \classes\URL::create('site/contact'),
                            ),
                        ),
                        ($this->auth->checkAuth() ? array(
                            'link' => array(
                                'name' => 'Logout',
                                'url' => \classes\URL::create('site/logout'),
                            ),
                        ) : false),
                    ),
                    array(
                        'class' => 'nav nav-pills'
                    )
                );
                ?>
            </div>
                
            <?php if (!$this->auth->checkAuth()): ?>
            <div class="row errors">
                <?php if (isset($this->errors['login']) && !empty($this->errors['login'])) {
                    foreach ($this->errors['login'] as $error) {
                        echo $error;
                    }
                } ?>
            </div>
                
            <div id="login-form-holder">
                <?=classes\Html::formBegin('', 'post', array('id'=>'login-form'));?>

                <div class="span3">
                    <?=classes\Html::textField('username', '', array('placeholder' => 'Username'));?>
                </div>

                <div class="span3">
                    <?=classes\Html::passwordField('password', '', array('placeholder' => 'Password'));?>
                </div>

                <div class="span2">
                    <?=classes\Html::submitButton('Login', array('class' => 'button no-margin'));?>
                </div>

                <div class="span2">
                    <?=classes\Html::hiddenField('login');?>
                </div>
                <?=classes\Html::formEnd();?>
            </div>
            <?php endif; ?>
            
            <div class="row">

                <?=$content;?>

            </div>
            
        </div>
            
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="<?=ROOT_HOST;?>/js/bootstrap.min.js"></script>
    </body>
</html>
