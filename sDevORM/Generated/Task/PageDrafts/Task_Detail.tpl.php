<?php $strPageTitle = 'Task Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Task Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Task/TaskFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveTask->Render();?>
        <?php $this->btnDeleteTask->Render();?>
        <?php $this->btnCancelTask->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>