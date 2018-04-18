<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('FirstName');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('Surname');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('IDPassportNumber');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('DateOfBirth');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('TelephoneNumber');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('AlternativeTelephoneNumber');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('Nationality');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('EthnicGroup');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('DriversLicense');?>
    </div>
    <div class="col-md-6">
        <?php $this->PersonInstance->renderControl('CurrentAddress');?>
    </div>
</div>