<?php $strPageTitle = 'EmailTemplateContentRow Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailTemplateContentRow Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveEmailTemplateContentRow->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteEmailTemplateContentRow->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelEmailTemplateContentRow->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>