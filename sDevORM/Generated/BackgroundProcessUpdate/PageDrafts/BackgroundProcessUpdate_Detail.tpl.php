<?php $strPageTitle = 'BackgroundProcessUpdate Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">BackgroundProcessUpdate Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveBackgroundProcessUpdate->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteBackgroundProcessUpdate->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelBackgroundProcessUpdate->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>