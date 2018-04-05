<?php $strPageTitle = 'Course Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Course Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Course/CourseFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveCourse->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteCourse->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelCourse->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>