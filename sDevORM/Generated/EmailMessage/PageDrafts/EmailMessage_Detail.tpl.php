<?php $strPageTitle = 'EmailMessage Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailMessage Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/EmailMessage/EmailMessageFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveEmailMessage->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteEmailMessage->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelEmailMessage->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>