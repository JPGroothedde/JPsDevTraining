<?php
?>

<div class="row">
    <div class="col-md-6">
        <h4 class="page-header">Template Name</h4>
        <?php $this->EmailTemplateInstance->renderControl('TemplateName',false);?>
    </div>
    <div class="col-md-6">
        <h4 class="page-header">Status</h4>
		<?php $this->EmailTemplateInstance->renderControl('Published',false);?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h4 class="page-header">CC Addresses</h4>
		<?php $this->EmailTemplateInstance->renderControl('CcAddresses',false);?>
    </div>
    <div class="col-md-6">
        <h4 class="page-header">BCC Addresses</h4>
		<?php $this->EmailTemplateInstance->renderControl('BccAddresses',false);?>
    </div>
</div>