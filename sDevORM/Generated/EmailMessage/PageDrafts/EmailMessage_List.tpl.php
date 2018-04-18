<?php $strPageTitle = 'EmailMessage List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/EmailMessage/EmailMessageModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailMessage List</h3>
        <?php $this->EmailMessageList->RenderList();?>
        <?php $this->btnNewEmailMessage->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>