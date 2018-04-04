<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->CommentInstance->renderControl('CommentText');?>
    </div>
    <div class="col-md-6">
        <?php $this->CommentInstance->renderControl('DateCreated');?>
    </div>
    <div class="col-md-6">
        <?php $this->CommentInstance->renderControl('DateCreatedTime',true,'Time');?>
    </div>
</div>