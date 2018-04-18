<?php $strPageTitle = 'EmploymentHistory Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">EmploymentHistory Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveEmploymentHistory->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteEmploymentHistory->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelEmploymentHistory->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>