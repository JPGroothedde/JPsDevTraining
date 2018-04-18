<?php
?>

<div class="row">
    <div class="col-md-4">
        <?php $this->AuditLogEntryInstance->renderControl('EntryTimeStamp');?>
    </div>
    <div class="col-md-4">
        <?php $this->AuditLogEntryInstance->renderControl('ObjectName');?>
    </div>
    <div class="col-md-4">
        <?php $this->AuditLogEntryInstance->renderControl('ObjectId');?>
    </div>
    <div class="col-md-4">
        <?php $this->AuditLogEntryInstance->renderControl('ModificationType');?>
    </div>
    <div class="col-md-4">
        <?php $this->AuditLogEntryInstance->renderControl('UserEmail');?>
    </div>
    <div class="col-md-12">
        <?php $this->AuditLogEntryInstance->renderControl('AuditLogEntryDetail');?>
    </div>
</div>