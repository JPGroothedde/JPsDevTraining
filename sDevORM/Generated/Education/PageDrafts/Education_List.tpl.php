<?php $strPageTitle = 'Education List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Education/EducationModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Education List</h3>
        <?php $this->EducationList->RenderList();?>
        <?php $this->btnNewEducation->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>