<?php $strPageTitle = 'PageView Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PageView Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PageView/PageViewFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePageView->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePageView->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPageView->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>