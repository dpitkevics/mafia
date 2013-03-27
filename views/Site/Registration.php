<div class="row">
    <?=classes\Html::formBegin();?>
    
    <div class="row">
        <div class="span8 errors">
            <?php if (isset($this->errors['Users']) && !empty($this->errors['Users'])) {
                foreach ($this->errors['Users'] as $error) {
                    echo $error;
                }
            } ?>
        </div>
    </div>
    
    <fieldset>
        <legend>Primary data</legend>
        
        <div class="row">

            <div class="span1">
                <?=classes\Html::label($model->get('username'), $model->getAttribute('username'), true);?>
            </div>
            <div class="span3">
                <?=classes\Html::textField($model->get('username'));?>
            </div>

        </div>

        <div class="row">

            <div class="span1">
                <?=classes\Html::label($model->get('password'), $model->getAttribute('password'), true);?>
            </div>
            <div class="span3">
                <?=classes\Html::passwordField($model->get('password'));?>
            </div>

        </div>
        
        <div class="row">
            
            <div class="span1">
                <?=classes\Html::label($model->get('password_ver'), $model->getAttribute('password_ver'), true);?>
            </div>
            <div class="span3">
                <?=classes\Html::passwordField($model->get('password_ver'));?>
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="span1">
                <?=classes\Html::label($model->get('email'), $model->getAttribute('email'), true);?>
            </div>
            <div class="span3">
                <?=classes\Html::textField($model->get('email'));?>
            </div>
            
        </div>
        
    </fieldset>
    
    <fieldset>
        <legend>Additional data</legend>
        
        <div class="row">
            
            <div class="span1">
                <?=classes\Html::label($model->get('name'), $model->getAttribute('name'));?>
            </div>
            <div class="span3">
                <?=classes\Html::textField($model->get('name'));?>
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="span1">
                <?=classes\Html::label($model->get('surname'), $model->getAttribute('surname'));?>
            </div>
            <div class="span3">
                <?=classes\Html::textField($model->get('surname'));?>
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="span1">
                <?=classes\Html::label($model->get('age'), $model->getAttribute('age'));?>
            </div>
            <div class="span3">
                <?=classes\Html::dropDownField($model->get('age'), 'range:10-70');?>
            </div>
            
        </div>
        
    </fieldset>
    
    <fieldset>
        <legend>Referer</legend>
        
        <div class="row">
            
            <div class="span1">
                <?=classes\Html::label($model->get('refered_by'), $model->getAttribute('refered_by'));?>
            </div>
            <div class="span3">
                <?=classes\Html::textField($model->get('refered_by'));?>
            </div>
            
        </div>
        
    </fieldset>
    
    <div class="row">
        <?=classes\Html::submitButton('Register', array('class' => 'button'));?>
    </div>
    <?=classes\Html::formEnd();?>
</div>