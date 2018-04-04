<?php require(__CONFIGURATION__ . '/header_anon.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default mrg-top10">
            <div class="panel-heading">Please Log In</div>
            <div class="panel-body">
                <img src="<?php echo AppSpecificFunctions::getAppLogoUrl();?>" alt="Logo" class="img-rounded img-responsive mrg-bottom15">
                <?php $this->sUsername->Render(); ?>
                <?php $this->sPassword->Render(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php $this->btnSaveLogin->Render(); ?>
                    </div>
                    <div class="col-lg-6">
                        <?php $this->btnForgottenPassword->Render();?>
                    </div>
                </div>
                <?php $this->btnLogin->Render(); ?>
            </div>
            <!--<div class="panel-footer">

            </div>-->
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $this->RenderEnd() ?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>