<?php $strPageTitle = 'PostLike Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PostLike Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PostLike/PostLikeFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePostLike->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePostLike->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPostLike->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>