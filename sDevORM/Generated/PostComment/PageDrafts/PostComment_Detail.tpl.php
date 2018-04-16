<?php $strPageTitle = 'PostComment Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PostComment Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PostComment/PostCommentFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePostComment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePostComment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPostComment->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>