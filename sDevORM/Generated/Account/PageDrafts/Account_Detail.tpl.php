<?php $strPageTitle = 'Account Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Account Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Account/AccountFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveAccount->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteAccount->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelAccount->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>