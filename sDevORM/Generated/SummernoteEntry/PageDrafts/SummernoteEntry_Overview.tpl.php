<?php $strPageTitle = 'SummernoteEntry Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/SummernoteEntry/SummernoteEntryModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">SummernoteEntry Overview</h3>
        <?php $this->SummernoteEntryGrid->RenderGrid();?>
        <?php $this->btnNewSummernoteEntry->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>