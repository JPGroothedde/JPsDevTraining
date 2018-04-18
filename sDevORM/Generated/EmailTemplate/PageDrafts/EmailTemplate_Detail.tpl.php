<?php $strPageTitle = 'EmailTemplate Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailTemplate Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/EmailTemplate/EmailTemplateFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveEmailTemplate->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteEmailTemplate->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelEmailTemplate->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>