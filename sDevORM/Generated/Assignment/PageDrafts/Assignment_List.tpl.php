<?php $strPageTitle = 'Assignment List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Assignment/AssignmentModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Assignment List</h3>
        <?php $this->AssignmentList->RenderList();?>
        <?php $this->btnNewAssignment->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>