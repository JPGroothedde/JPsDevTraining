<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->PostInstance->renderControl('PostText');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostInstance->renderControl('PostTimeStamp');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostInstance->renderControl('PostTimeStampTime',true,'Time');?>
    </div>
</div>