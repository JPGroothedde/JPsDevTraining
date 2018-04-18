<?php $strPageTitle = 'PasswordReset Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PasswordReset/PasswordResetModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PasswordReset Overview</h3>
        <?php $this->PasswordResetGrid->RenderGrid();?>
        <?php $this->btnNewPasswordReset->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>