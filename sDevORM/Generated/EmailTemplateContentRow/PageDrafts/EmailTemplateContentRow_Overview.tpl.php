<?php $strPageTitle = 'EmailTemplateContentRow Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailTemplateContentRow Overview</h3>
        <?php $this->EmailTemplateContentRowGrid->RenderGrid();?>
        <?php $this->btnNewEmailTemplateContentRow->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>