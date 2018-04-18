<?php $strPageTitle = 'UserRole Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/UserRole/UserRoleModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">UserRole Overview</h3>
        <?php $this->UserRoleGrid->RenderGrid();?>
        <?php $this->btnNewUserRole->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>