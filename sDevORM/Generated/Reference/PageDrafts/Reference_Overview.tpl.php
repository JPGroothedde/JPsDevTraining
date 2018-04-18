<?php $strPageTitle = 'Reference Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Reference/ReferenceModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Reference Overview</h3>
        <?php $this->ReferenceGrid->RenderGrid();?>
        <?php $this->btnNewReference->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>