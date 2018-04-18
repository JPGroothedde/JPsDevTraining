<?php $strPageTitle = 'FileDocument Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/FileDocument/FileDocumentModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">FileDocument Overview</h3>
        <?php $this->FileDocumentGrid->RenderGrid();?>
        <?php $this->btnNewFileDocument->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>