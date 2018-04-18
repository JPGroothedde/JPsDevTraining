<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->ReferenceInstance->renderControl('FirstName');?>
    </div>
    <div class="col-md-6">
        <?php $this->ReferenceInstance->renderControl('Surname');?>
    </div>
    <div class="col-md-6">
        <?php $this->ReferenceInstance->renderControl('Relationship');?>
    </div>
    <div class="col-md-6">
        <?php $this->ReferenceInstance->renderControl('TelephoneNumber');?>
    </div>
</div>