<?php $strPageTitle = 'Remote Access';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default mrg-top10">
                <div class="panel-heading">Remote Access</div>
                <div class="panel-body">
                    <img src="<?php echo AppSpecificFunctions::getAppLogoUrl();?>" alt="Logo" class="img-rounded img-responsive mrg-bottom15">
                    <?php $this->txtMaintenancePwd->RenderWithName();?>
                    <?php $this->btnCheckPwd->Render();?>
                </div>
                <div class="panel-footer">
                    <a href="<?php echo __PHP_ASSETS__?>/_devtools/start_page.php">Management Console</a>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>



<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>