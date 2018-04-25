<?php $strPageTitle = 'PersonAttachment Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PersonAttachment/PersonAttachmentModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PersonAttachment Overview</h3>
        <?php $this->PersonAttachmentGrid->RenderGrid();?>
        <?php $this->btnNewPersonAttachment->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>