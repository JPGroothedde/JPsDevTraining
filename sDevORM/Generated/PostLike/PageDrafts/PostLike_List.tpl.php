<?php $strPageTitle = 'PostLike List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PostLike/PostLikeModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PostLike List</h3>
        <?php $this->PostLikeList->RenderList();?>
        <?php $this->btnNewPostLike->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>