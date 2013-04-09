<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Testing</title>
        <meta charset="utf8">

        <link rel="stylesheet" href="<?php echo ROOT_HOST;?>/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo ROOT_HOST;?>/css/main.css" />
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                
                <div class="row">
                    <div class="span8">
                        <?php echo classes\Html::unorderedList(
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
                </div>
                
                <div class="row">
                    
                    <div class="span8">
                        <?php echo $content; ?>
                    </div>
                    
                    <?php if ($this->auth->checkAuth()): ?>
                    <div class="span3">
                        <div class="row">
                            <div class="alert alert-success">
                                <div class="row">
                                    Greetings, <?php echo $this->user->username;?>!
                                </div>
                                <div class="row">
                                    News of Your <?php echo $this->user->char_name; ?> account.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="alert alert-info energy-box">
                                <div class="row">
                                    Energy:
                                </div>
                                <div class="progress progress-info">
                                    <div class="bar" style="width: <?php echo $this->user->energy_level;?>%;">
                                        <?php echo ceil(($this->user->energy_max / 100) * $this->user->energy_level);?> of <?php echo $this->user->energy_max;?>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php $timeTillEnergyUpdate = (ENERGY_UPDATE_TIME - (time()-$this->user->energy_update_timestamp)); ?>
                                    Energy update in: <?php echo (($timeTillEnergyUpdate <= 0)?"Updating Energy":$timeTillEnergyUpdate . " sec");?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="alert alert-danger hp-box">
                                <div class="row">
                                    HP:
                                </div>
                                <div class="progress progress-danger">
                                    <div class="bar" style="width: <?php echo $this->user->current_hp; ?>%;">
                                        <?php echo ceil(($this->user->char_max_hp / 100) * $this->user->current_hp);?> of <?php echo $this->user->char_max_hp;?>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php $timeTillHpUpdate = ($this->user->char_hp_recovery_time - (time()-$this->user->hp_update_timestamp)); ?>
                                    HP update in: <?php echo (($timeTillHpUpdate <= 0)?"Updating HP":$timeTillHpUpdate . " sec");?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                </div>
                
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
                <?php echo classes\Html::formBegin('', 'post', array('id'=>'login-form'));?>

                <div class="span3">
                    <?php echo classes\Html::textField('username', '', array('placeholder' => 'Username'));?>
                </div>

                <div class="span3">
                    <?php echo classes\Html::passwordField('password', '', array('placeholder' => 'Password'));?>
                </div>

                <div class="span2">
                    <?php echo classes\Html::submitButton('Login', array('class' => 'button no-margin'));?>
                </div>

                <div class="span2">
                    <?php echo classes\Html::hiddenField('login');?>
                </div>
                <?php echo classes\Html::formEnd();?>
            </div>
            <?php endif; ?>
            
            
            
        </div>
            
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="<?php echo ROOT_HOST;?>/js/bootstrap.min.js"></script>
        <script>
            setInterval(function () {
                <?php echo \classes\JS::ajaxCall(classes\URL::create('ajax/counter/hp'), array(), array(
                    'success' => 'function (html) { $(".hp-box").html(html); }',
                )); ?>
                <?php echo \classes\JS::ajaxCall(classes\URL::create('ajax/counter/energy'), array(), array(
                    'success' => 'function (html) { $(".energy-box").html(html); }',
                )); ?>
            }, 1000);
        </script>
    </body>
</html>
