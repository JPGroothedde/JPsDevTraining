<?php $strPageTitle = 'EmploymentHistory List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmploymentHistory List</h3>
        <?php $this->EmploymentHistoryList->RenderList();?>
        <?php $this->btnNewEmploymentHistory->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>