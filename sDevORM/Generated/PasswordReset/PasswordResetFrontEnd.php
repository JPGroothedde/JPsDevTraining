<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->PasswordResetInstance->renderControl('Token');?>
    </div>
    <div class="col-md-6">
        <?php $this->PasswordResetInstance->renderControl('CreatedDateTime');?>
    </div>
    <div class="col-md-6">
        <?php $this->PasswordResetInstance->renderControl('CreatedDateTimeTime',true,'Time');?>
    </div>
</div>