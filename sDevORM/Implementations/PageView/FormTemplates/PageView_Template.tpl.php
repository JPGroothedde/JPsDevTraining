<?php $strPageTitle = 'PageView Template';?>
<?php require(__CONFIGURATION__ . '/header.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/PageView/PageViewFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSavePageView->Render();?>
        <?php $this->btnDeletePageView->Render();?>
        <?php $this->btnCancelPageView->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>