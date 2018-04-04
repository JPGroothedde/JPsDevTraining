<?php $strPageTitle = 'Comment Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Comment Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Comment/CommentFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveComment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteComment->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelComment->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>