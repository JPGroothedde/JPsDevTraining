<?php $strPageTitle = 'BackgroundProcessUpdate Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">BackgroundProcessUpdate Overview</h3>
        <?php $this->BackgroundProcessUpdateGrid->RenderGrid();?>
        <?php $this->btnNewBackgroundProcessUpdate->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>