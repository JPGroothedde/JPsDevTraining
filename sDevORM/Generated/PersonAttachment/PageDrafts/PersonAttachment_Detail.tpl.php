<?php $strPageTitle = 'PersonAttachment Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PersonAttachment Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PersonAttachment/PersonAttachmentFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePersonAttachment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePersonAttachment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPersonAttachment->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>