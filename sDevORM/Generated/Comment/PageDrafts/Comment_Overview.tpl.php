<?php $strPageTitle = 'Comment Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Comment/CommentModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Comment Overview</h3>
        <?php $this->CommentGrid->RenderGrid();?>
        <?php $this->btnNewComment->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>