<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->EmailTemplateContentBlockInstance->renderControl('ContentBlock');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailTemplateContentBlockInstance->renderControl('ContentType');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailTemplateContentBlockInstance->renderControl('Position');?>
    </div>
</div>