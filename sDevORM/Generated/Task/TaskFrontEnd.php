<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->TaskInstance->renderControl('Name');?>
    </div>
    <div class="col-md-6">
        <?php $this->TaskInstance->renderControl('Description');?>
    </div>
    <div class="col-md-6">
        <?php $this->TaskInstance->renderControl('DueDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->TaskInstance->renderControl('Status');?>
    </div>
</div>