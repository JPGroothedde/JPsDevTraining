<?php $strPageTitle = 'PasswordReset Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PasswordReset Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PasswordReset/PasswordResetFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePasswordReset->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePasswordReset->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPasswordReset->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>