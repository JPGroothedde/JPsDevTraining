<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->EmailTemplateInstance->renderControl('TemplateName');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailTemplateInstance->renderControl('CcAddresses');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailTemplateInstance->renderControl('BccAddresses');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailTemplateInstance->renderControl('Published');?>
    </div>
</div>