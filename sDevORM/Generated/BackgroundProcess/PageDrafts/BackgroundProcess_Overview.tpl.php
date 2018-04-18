<?php $strPageTitle = 'BackgroundProcess Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">BackgroundProcess Overview</h3>
        <?php $this->BackgroundProcessGrid->RenderGrid();?>
        <?php $this->btnNewBackgroundProcess->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>