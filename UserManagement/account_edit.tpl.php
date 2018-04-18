<?php	$strPageTitle = 'My Account'; ?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>
<?php $this->RenderBegin() ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">My Account</h1>
        <?php require(__SDEV_ORM__.'/Implementations/Account/AccountFrontEnd_Self.php');?>
        <div class="row">
            <div class="col-md-2"><?php $this->btnSave->Render(); ?></div>
            <div class="col-md-2"><?php $this->btnCancel->Render(); ?></div>
        </div>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ .'/footer.inc.php');?>
