<?php $strPageTitle = 'MasterLanguage Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/MasterLanguage/MasterLanguageModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">MasterLanguage Overview</h3>
        <?php $this->MasterLanguageGrid->RenderGrid();?>
        <?php $this->btnNewMasterLanguage->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>