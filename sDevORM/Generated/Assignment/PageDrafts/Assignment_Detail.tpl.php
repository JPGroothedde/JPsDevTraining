<?php $strPageTitle = 'Assignment Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Assignment Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Assignment/AssignmentFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveAssignment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteAssignment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelAssignment->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>