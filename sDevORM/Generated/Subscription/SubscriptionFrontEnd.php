<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->SubscriptionInstance->renderControl('StartDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->SubscriptionInstance->renderControl('EndDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->SubscriptionInstance->renderControl('AverageMark');?>
    </div>
</div>