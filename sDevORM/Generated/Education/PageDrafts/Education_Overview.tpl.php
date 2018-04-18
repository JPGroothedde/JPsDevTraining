<?php $strPageTitle = 'Education Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Education/EducationModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Education Overview</h3>
        <?php $this->EducationGrid->RenderGrid();?>
        <?php $this->btnNewEducation->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>