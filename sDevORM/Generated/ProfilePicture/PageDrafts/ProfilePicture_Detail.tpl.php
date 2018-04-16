<?php $strPageTitle = 'ProfilePicture Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">ProfilePicture Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/ProfilePicture/ProfilePictureFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveProfilePicture->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteProfilePicture->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelProfilePicture->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>