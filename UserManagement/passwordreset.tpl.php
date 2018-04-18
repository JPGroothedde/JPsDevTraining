<?php require(__CONFIGURATION__ . '/header_anon.inc.php');	?>

<?php $this->RenderBegin() ?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default mrg-top10">
            <div class="panel-heading">Create a new password</div>
            <div class="panel-body">
                <img src="<?php echo AppSpecificFunctions::getAppLogoUrl();?>" alt="Logo" class="img-rounded img-responsive mrg-bottom15">
                <?php $this->sPassword->Render(); ?>
                <?php $this->sPasswordConfirm->Render(); ?>
                <?php $this->btnReset->Render(); ?>
            </div>
            <div class="panel-footer">
                <a href="<?php echo __USRMNG__.'/login/'?>">Back to Login page</a>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>



