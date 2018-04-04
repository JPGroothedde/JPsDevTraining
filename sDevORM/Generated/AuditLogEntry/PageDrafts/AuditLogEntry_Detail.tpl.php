<?php $strPageTitle = 'AuditLogEntry Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">AuditLogEntry Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/AuditLogEntry/AuditLogEntryFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveAuditLogEntry->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteAuditLogEntry->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelAuditLogEntry->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>