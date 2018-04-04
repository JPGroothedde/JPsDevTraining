<?php $strPageTitle = 'EmailTemplateContentRow List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmailTemplateContentRow List</h3>
        <?php $this->EmailTemplateContentRowList->RenderList();?>
        <?php $this->btnNewEmailTemplateContentRow->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>