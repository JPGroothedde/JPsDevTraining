<?php $strPageTitle = 'SummernoteEntry Template';?>
<?php require(__CONFIGURATION__ . '/header.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/SummernoteEntry/SummernoteEntryFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveSummernoteEntry->Render();?>
        <?php $this->btnDeleteSummernoteEntry->Render();?>
        <?php $this->btnCancelSummernoteEntry->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>