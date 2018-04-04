<?php $strPageTitle = 'ApiEntity Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/ApiEntity/ApiEntityModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">ApiEntity Overview</h3>
        <?php $this->ApiEntityGrid->RenderGrid();?>
        <?php $this->btnNewApiEntity->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>