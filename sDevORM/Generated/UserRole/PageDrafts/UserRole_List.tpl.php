<?php $strPageTitle = 'UserRole List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/UserRole/UserRoleModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">UserRole List</h3>
        <?php $this->UserRoleList->RenderList();?>
        <?php $this->btnNewUserRole->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>