<?php $strPageTitle = 'PersonAttachment Template';?>
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
        <?php require(__SDEV_ORM__.'/Implementations/PersonAttachment/PersonAttachmentFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSavePersonAttachment->Render();?>
        <!--<?php $this->btnDeletePersonAttachment->Render();?>
        <?php $this->btnCancelPersonAttachment->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>