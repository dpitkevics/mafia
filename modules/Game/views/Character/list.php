<div class="row">
    <div class="row">
        <h2>Profile of <?php echo $user->username;?> (<?php echo $user->char_name;?>)</h2>
    </div>
    <div class="row">
        <?php foreach ($user as $key => $value): ?>
            <div class="row">
                <?php echo ucfirst(str_replace('_', ' ', $key));?>: <?php echo $value;?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
