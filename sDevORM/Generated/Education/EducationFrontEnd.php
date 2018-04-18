<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->EducationInstance->renderControl('Institution');?>
    </div>
    <div class="col-md-6">
        <?php $this->EducationInstance->renderControl('StartDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->EducationInstance->renderControl('EndDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->EducationInstance->renderControl('Qualification');?>
    </div>
</div>