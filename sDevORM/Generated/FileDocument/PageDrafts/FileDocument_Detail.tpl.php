<?php $strPageTitle = 'FileDocument Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">FileDocument Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/FileDocument/FileDocumentFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveFileDocument->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteFileDocument->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelFileDocument->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>