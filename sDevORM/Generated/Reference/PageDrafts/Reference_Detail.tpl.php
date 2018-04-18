<?php $strPageTitle = 'Reference Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Reference Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Reference/ReferenceFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveReference->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteReference->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelReference->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>