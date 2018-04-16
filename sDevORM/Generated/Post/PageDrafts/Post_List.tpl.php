<?php $strPageTitle = 'Post List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Post/PostModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Post List</h3>
        <?php $this->PostList->RenderList();?>
        <?php $this->btnNewPost->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>