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
        </div>
        <div class="span4">
            <div class="row">
                <h4>Skill training</h4>
            </div>
        </div>
    </div>
</div>