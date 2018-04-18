<?php $strPageTitle = 'Education Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Education Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Education/EducationFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveEducation->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteEducation->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelEducation->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>