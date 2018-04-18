<?php $strPageTitle = 'ApiKey Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">ApiKey Overview</h3>
        <?php $this->ApiKeyGrid->RenderGrid();?>
        <?php $this->btnNewApiKey->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>