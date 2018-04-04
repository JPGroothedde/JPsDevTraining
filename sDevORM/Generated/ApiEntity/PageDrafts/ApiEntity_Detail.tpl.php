<?php $strPageTitle = 'ApiEntity Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">ApiEntity Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/ApiEntity/ApiEntityFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveApiEntity->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteApiEntity->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelApiEntity->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>