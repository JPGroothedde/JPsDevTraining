<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->AccountInstance->renderControl('FirstName');?>
    </div>
    <div class="col-md-6">
        <?php $this->AccountInstance->renderControl('LastName');?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php $this->AccountInstance->renderControl('EmailAddress');?>
    </div>
    <div class="col-md-6">
        <?php $this->AccountInstance->renderControl('Username');?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php $this->AccountInstance->renderControl('Password');?>
    </div>

</div>