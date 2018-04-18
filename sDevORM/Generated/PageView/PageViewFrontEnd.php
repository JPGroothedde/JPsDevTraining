<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->PageViewInstance->renderControl('TimeStamped');?>
    </div>
    <div class="col-md-6">
        <?php $this->PageViewInstance->renderControl('TimeStampedTime',true,'Time');?>
    </div>
    <div class="col-md-6">
        <?php $this->PageViewInstance->renderControl('IPAddress');?>
    </div>
    <div class="col-md-6">
        <?php $this->PageViewInstance->renderControl('PageDetails');?>
    </div>
    <div class="col-md-6">
        <?php $this->PageViewInstance->renderControl('UserAgentDetails');?>
    </div>
    <div class="col-md-6">
        <?php $this->PageViewInstance->renderControl('UserRole');?>
    </div>
    <div class="col-md-6">
        <?php $this->PageViewInstance->renderControl('Username');?>
    </div>
</div>