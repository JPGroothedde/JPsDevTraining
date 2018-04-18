<?php $strPageTitle = 'Person Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Person/PersonModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Person Overview</h3>
        <?php $this->PersonGrid->RenderGrid();?>
        <?php $this->btnNewPerson->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>