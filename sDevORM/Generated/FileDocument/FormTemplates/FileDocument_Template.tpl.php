<?php $strPageTitle = 'FileDocument Template';?>
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
        <?php require(__SDEV_ORM__.'/Implementations/FileDocument/FileDocumentFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveFileDocument->Render();?>
        <!--<?php $this->btnDeleteFileDocument->Render();?>
        <?php $this->btnCancelFileDocument->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>