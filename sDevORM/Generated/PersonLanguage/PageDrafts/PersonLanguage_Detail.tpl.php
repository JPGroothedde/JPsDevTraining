<?php $strPageTitle = 'PersonLanguage Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PersonLanguage Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PersonLanguage/PersonLanguageFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePersonLanguage->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePersonLanguage->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPersonLanguage->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>