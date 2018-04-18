<?php $strPageTitle = 'RemoteAccess Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">RemoteAccess Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/RemoteAccess/RemoteAccessFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveRemoteAccess->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteRemoteAccess->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelRemoteAccess->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>