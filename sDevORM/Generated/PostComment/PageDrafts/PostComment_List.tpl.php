<?php $strPageTitle = 'PostComment List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PostComment/PostCommentModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PostComment List</h3>
        <?php $this->PostCommentList->RenderList();?>
        <?php $this->btnNewPostComment->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>