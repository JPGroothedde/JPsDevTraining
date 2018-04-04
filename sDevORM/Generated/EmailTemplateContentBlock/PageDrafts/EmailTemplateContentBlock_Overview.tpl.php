<?php $strPageTitle = 'EmailTemplateContentBlock Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailTemplateContentBlock Overview</h3>
        <?php $this->EmailTemplateContentBlockGrid->RenderGrid();?>
        <?php $this->btnNewEmailTemplateContentBlock->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>