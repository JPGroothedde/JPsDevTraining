<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->AssignmentInstance->renderControl('Name');?>
    </div>
    <div class="col-md-6">
        <?php $this->AssignmentInstance->renderControl('Status');?>
    </div>
    <div class="col-md-6">
        <?php $this->AssignmentInstance->renderControl('FinalMark');?>
    </div>
</div>