<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->PostInstance->renderControl('PostText');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostInstance->renderControl('DateCreated');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostInstance->renderControl('DateCreatedTime',true,'Time');?>
    </div>
</div>