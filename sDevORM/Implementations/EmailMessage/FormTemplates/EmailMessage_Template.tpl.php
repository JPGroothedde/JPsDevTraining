<?php $strPageTitle = 'EmailMessage Template';?>
<?php require(__CONFIGURATION__ . '/header.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/EmailMessage/EmailMessageFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveEmailMessage->Render();?>
        <?php $this->btnDeleteEmailMessage->Render();?>
        <?php $this->btnCancelEmailMessage->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>