<?php $strPageTitle = 'ApiKey Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">ApiKey Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveApiKey->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteApiKey->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelApiKey->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>