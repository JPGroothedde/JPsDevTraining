<?php $strPageTitle = 'Task Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Task/TaskModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Task Overview</h3>
        <?php $this->TaskGrid->RenderGrid();?>
        <?php $this->btnNewTask->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>