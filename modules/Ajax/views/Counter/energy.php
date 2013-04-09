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
    Energy update in: <?php echo ($this->user->energy_level == 100)?"Max":(($timeTillEnergyUpdate <= 0)?"Updating Energy":$timeTillEnergyUpdate);?> <?php echo ($this->user->energy_level == 100)?"":"sec" ?>
</div>