<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->FileDocumentInstance->renderControl('FileName');?>
    </div>
    <div class="col-md-6">
        <?php $this->FileDocumentInstance->renderControl('Path');?>
    </div>
    <div class="col-md-6">
        <?php $this->FileDocumentInstance->renderControl('CreatedDate');?>
    </div>
</div>