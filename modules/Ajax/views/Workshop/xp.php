<div class="row">
    Exp:
</div>
<div class="progress progress-warning">
    <div class="bar" style="width: <?php echo (($this->user->char_next_level_xp - $this->user->char_this_level_xp) / 100) * ($this->user->char_exp - $this->user->char_this_level_xp); ?>%;">
        <?php echo $this->user->char_exp; ?> of <?php echo $this->user->char_next_level_xp;?>
    </div>
</div>
<div class="row">
    Your level: <?php echo $this->user->char_level; ?>
</div>
<div class="row">
    Your title: <?php echo $this->user->char_title; ?>
</div>