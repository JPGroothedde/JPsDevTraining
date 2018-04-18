<?php $strPageTitle = 'SummernoteEntry Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">SummernoteEntry Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/SummernoteEntry/SummernoteEntryFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveSummernoteEntry->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteSummernoteEntry->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelSummernoteEntry->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>