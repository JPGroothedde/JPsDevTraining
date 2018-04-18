<?php $strPageTitle = 'EmailTemplateContentBlock Template';?>
<?php require(__CONFIGURATION__ . '/header_form_templates.inc.php');	?>
<style>
    body {
        padding: 0px;
        margin:0px;
    }
</style>
<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveEmailTemplateContentBlock->Render();?>
        <!--<?php $this->btnDeleteEmailTemplateContentBlock->Render();?>
        <?php $this->btnCancelEmailTemplateContentBlock->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>