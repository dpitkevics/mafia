<div class="row">
    <div class="row">
        <h2>Profile of <?=$user->username;?> (<?=$user->char_name;?>)</h2>
    </div>
    <div class="row">
        <?php foreach ($user as $key => $value): ?>
            <div class="row">
                <?=ucfirst(str_replace('_', ' ', $key));?>: <?=$value;?>
            </div>
        <?php endforeach; ?>
    </div>
</div>