<?php $strPageTitle = 'Post Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Post Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Post/PostFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePost->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePost->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPost->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>