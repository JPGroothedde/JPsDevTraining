<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->PostCommentInstance->renderControl('PostCommentText');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostCommentInstance->renderControl('PostTimeStamp');?>
    </div>
    <div class="col-md-6">
        <?php $this->PostCommentInstance->renderControl('PostTimeStampTime',true,'Time');?>
    </div>
</div>