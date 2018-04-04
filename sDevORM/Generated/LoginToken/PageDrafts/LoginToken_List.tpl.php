<?php $strPageTitle = 'LoginToken List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/LoginToken/LoginTokenModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">LoginToken List</h3>
        <?php $this->LoginTokenList->RenderList();?>
        <?php $this->btnNewLoginToken->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>