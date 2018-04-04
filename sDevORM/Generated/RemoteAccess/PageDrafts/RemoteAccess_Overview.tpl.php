<?php $strPageTitle = 'RemoteAccess Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/RemoteAccess/RemoteAccessModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">RemoteAccess Overview</h3>
        <?php $this->RemoteAccessGrid->RenderGrid();?>
        <?php $this->btnNewRemoteAccess->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>