<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->StudentInstance->renderControl('FirstName');?>
    </div>
    <div class="col-md-6">
        <?php $this->StudentInstance->renderControl('LastName');?>
    </div>
    <div class="col-md-6">
        <?php $this->StudentInstance->renderControl('EmailAddress');?>
    </div>
</div>