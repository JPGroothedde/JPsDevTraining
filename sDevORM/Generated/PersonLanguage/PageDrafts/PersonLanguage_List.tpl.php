<?php $strPageTitle = 'PersonLanguage List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PersonLanguage/PersonLanguageModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PersonLanguage List</h3>
        <?php $this->PersonLanguageList->RenderList();?>
        <?php $this->btnNewPersonLanguage->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>