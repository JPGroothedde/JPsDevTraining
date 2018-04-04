<?php $strPageTitle = 'API Keys';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Api Key Overview</h3>
        <?php $this->btnNewApiKey->Render();?>
        <?php $this->ApiKeyGrid->RenderGrid();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>