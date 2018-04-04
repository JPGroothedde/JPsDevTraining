<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->SummernoteEntryInstance->renderControl('EntryHtml');?>
    </div>
    <div class="col-md-6">
        <?php $this->SummernoteEntryInstance->renderControl('AuthorId');?>
    </div>
    <div class="col-md-6">
        <?php $this->SummernoteEntryInstance->renderControl('LastChangedDate');?>
    </div>
</div>