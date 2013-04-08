<div class="row">
    <div class="row">
        <h3><?php echo $name;?> has been successfully completed.</h3>
    </div>
    <?php if (isset($alt) && !empty($alt)): ?>
    <div class="row">
        <h4><?php echo $alt;?></h4>
    </div>
    <?php endif; ?>
</div>
