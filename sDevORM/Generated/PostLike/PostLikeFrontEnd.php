<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->PostLikeInstance->renderControl('PostLike');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostLikeInstance->renderControl('DateCreated');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostLikeInstance->renderControl('DateCreatedTime',true,'Time');?>
    </div>
</div>