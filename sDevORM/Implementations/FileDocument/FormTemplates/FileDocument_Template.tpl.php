<?php $strPageTitle = 'FileDocument Template';?>
<?php require(__CONFIGURATION__ . '/header.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/FileDocument/FileDocumentFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveFileDocument->Render();?>
        <?php $this->btnDeleteFileDocument->Render();?>
        <?php $this->btnCancelFileDocument->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>