<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->EmploymentHistoryInstance->renderControl('PeriodStartDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmploymentHistoryInstance->renderControl('PeriodEndDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmploymentHistoryInstance->renderControl('EmployerName');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmploymentHistoryInstance->renderControl('Title');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmploymentHistoryInstance->renderControl('Duties');?>
    </div>
</div>