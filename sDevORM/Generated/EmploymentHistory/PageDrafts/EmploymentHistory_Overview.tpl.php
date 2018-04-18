<?php $strPageTitle = 'EmploymentHistory Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmploymentHistory Overview</h3>
        <?php $this->EmploymentHistoryGrid->RenderGrid();?>
        <?php $this->btnNewEmploymentHistory->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>