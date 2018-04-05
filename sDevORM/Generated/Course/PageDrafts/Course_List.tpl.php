<?php $strPageTitle = 'Course List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Course/CourseModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Course List</h3>
        <?php $this->CourseList->RenderList();?>
        <?php $this->btnNewCourse->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>