<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('PId');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('UserId');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('UpdateDateTime');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('UpdateDateTimeTime',true,'Time');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('Status');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('Summary');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('StartDateTime');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessInstance->renderControl('StartDateTimeTime',true,'Time');?>
    </div>
</div>