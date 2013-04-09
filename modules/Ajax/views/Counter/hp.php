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
    HP update in: <?php echo ($this->user->current_hp == 100)?"Max HP":(($timeTillHpUpdate <= 0)?"function updateHp();":$timeTillHpUpdate);?> <?php echo ($this->user->current_hp == 100)?"":"sec" ?>
</div>
