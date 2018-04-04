<?php $strPageTitle = 'EmailTemplate Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/EmailTemplate/EmailTemplateModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailTemplate Overview</h3>
        <?php $this->EmailTemplateGrid->RenderGrid();?>
        <?php $this->btnNewEmailTemplate->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>