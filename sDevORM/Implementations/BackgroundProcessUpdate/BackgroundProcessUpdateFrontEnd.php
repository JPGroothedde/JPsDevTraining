<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->BackgroundProcessUpdateInstance->renderControl('UpdateDateTime');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessUpdateInstance->renderControl('UpdateDateTimeTime',true,'Time');?>
    </div>
    <div class="col-md-6">
        <?php $this->BackgroundProcessUpdateInstance->renderControl('UpdateMessage');?>
    </div>
</div>