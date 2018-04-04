<?php $strPageTitle = 'EmailTemplateContentBlock Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailTemplateContentBlock Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveEmailTemplateContentBlock->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteEmailTemplateContentBlock->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelEmailTemplateContentBlock->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>