<?php $strPageTitle = 'AuditLogEntry List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/AuditLogEntry/AuditLogEntryModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">AuditLogEntry List</h3>
        <?php $this->AuditLogEntryList->RenderList();?>
        <?php $this->btnNewAuditLogEntry->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>