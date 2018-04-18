<?php $strPageTitle = 'BackgroundProcessUpdate List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">BackgroundProcessUpdate List</h3>
        <?php $this->BackgroundProcessUpdateList->RenderList();?>
        <?php $this->btnNewBackgroundProcessUpdate->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>