<div class="row">
    <div class="row">
        <h2>Workshop</h2>
    </div>
    <div class="row">
        <div class="span4">
            <div class="row">
                <h4>EXP training</h4>
            </div>
            <div class="row">
                <?php echo \classes\Html::ajaxLink(
                        '<i class="icon-certificate"></i>Basic learning (5 Exp / 30 Energy)', 
                        classes\URL::create('ajax/workshop/xp'), 
                        array('exp' => 5, 'energy' => 30), 
                        array(
                            'success' => 'function (html) { $(".xp-box").html(html); }'
                        )
                ); ?>
            </div>
            <div class="row">
                <?php echo \classes\Html::ajaxLink(
                        '<i class="icon-certificate"></i>Practical studies (12 Exp / 60 Energy)',
                        classes\URL::create('ajax/workshop/xp'),
                        array('exp' => 12, 'energy' => 60),
                        array(
                            'success' => 'function (html) { $(".xp-box").html(html); }'
                        )
                ); ?>
            </div>
            <div class="row">
                <?php echo \classes\Html::ajaxLink(
                        '<i class="icon-certificate"></i>Learning from boss (30 Exp / 125 Energy)',
                        classes\URL::create('ajax/workshop/xp'),
                        array('exp' => 30, 'energy' => 125),
                        array(
                            'success' => 'function (html) { $(".xp-box").html(html); }'
                        )
                ); ?>
            </div>
        </div>
        <div class="span4">
            <div class="row">
                <h4>Skill training</h4>
            </div>
        </div>
    </div>
</div>