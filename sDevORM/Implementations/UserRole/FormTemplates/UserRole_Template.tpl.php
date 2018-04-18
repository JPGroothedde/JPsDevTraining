<?php $strPageTitle = 'UserRole Template';?>
<?php require(__CONFIGURATION__ . '/header.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/UserRole/UserRoleFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveUserRole->Render();?>
        <?php $this->btnDeleteUserRole->Render();?>
        <?php $this->btnCancelUserRole->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>