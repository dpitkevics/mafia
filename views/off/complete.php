<div class="row">
    <div class="row">
        <h3><?=$name;?> has been successfully completed.</h3>
    </div>
    <?php if (isset($alt) && !empty($alt)): ?>
    <div class="row">
        <h4><?=$alt;?></h4>
    </div>
    <?php endif; ?>
</div>