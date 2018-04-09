<?php $strPageTitle = 'Student List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Student/StudentModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Student List</h3>
        <?php $this->StudentList->RenderList();?>
        <?php $this->btnNewStudent->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>