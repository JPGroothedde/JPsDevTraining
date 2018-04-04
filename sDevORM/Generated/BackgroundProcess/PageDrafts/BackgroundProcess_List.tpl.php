<?php $strPageTitle = 'BackgroundProcess List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">BackgroundProcess List</h3>
        <?php $this->BackgroundProcessList->RenderList();?>
        <?php $this->btnNewBackgroundProcess->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>