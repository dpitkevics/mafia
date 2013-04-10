<div class="row">
    <h5>Greetings, <?php echo $this->user->username;?>!</h5>
</div>
<div class="row">
    <h6>Character stats:</h6>
</div>
<div class="row">
    <div class="row">
        <div class="span2">
            Melee damage:
        </div>
        <?php echo $this->user->melee_damage; ?>
    </div>
    <div class="row">
        <div class="span2">
            Distance damage:
        </div>
        <?php echo $this->user->distance_damage; ?>
    </div>
    <div class="row">
        <div class="span2">
            Melee resistance:
        </div>
        <?php echo $this->user->melee_resistance; ?>
    </div>
    <div class="row">
        <div class="span2">
            Distance resistance:
        </div>
        <?php echo $this->user->distance_resistance; ?>
    </div>
    <div class="row">
        <div class="span2">
            Building speed:
        </div>
        <?php echo $this->user->building_speed; ?>
    </div>
</div>