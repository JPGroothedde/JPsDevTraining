<?php $strPageTitle = 'MasterLanguage Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">MasterLanguage Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/MasterLanguage/MasterLanguageFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveMasterLanguage->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteMasterLanguage->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelMasterLanguage->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>