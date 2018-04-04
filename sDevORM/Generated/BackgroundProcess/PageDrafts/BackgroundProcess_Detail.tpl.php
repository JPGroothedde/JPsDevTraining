<?php $strPageTitle = 'BackgroundProcess Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">BackgroundProcess Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveBackgroundProcess->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteBackgroundProcess->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelBackgroundProcess->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>