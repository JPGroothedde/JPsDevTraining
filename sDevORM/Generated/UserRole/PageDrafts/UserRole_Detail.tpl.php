<?php $strPageTitle = 'UserRole Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">UserRole Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/UserRole/UserRoleFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveUserRole->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteUserRole->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelUserRole->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>