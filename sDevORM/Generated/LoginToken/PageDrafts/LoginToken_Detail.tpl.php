<?php $strPageTitle = 'LoginToken Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">LoginToken Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/LoginToken/LoginTokenFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveLoginToken->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteLoginToken->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelLoginToken->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>