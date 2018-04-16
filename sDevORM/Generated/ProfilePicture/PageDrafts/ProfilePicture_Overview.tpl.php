<?php $strPageTitle = 'ProfilePicture Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/ProfilePicture/ProfilePictureModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">ProfilePicture Overview</h3>
        <?php $this->ProfilePictureGrid->RenderGrid();?>
        <?php $this->btnNewProfilePicture->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>