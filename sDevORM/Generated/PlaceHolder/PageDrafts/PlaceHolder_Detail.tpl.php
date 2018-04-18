<?php $strPageTitle = 'PlaceHolder Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PlaceHolder Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PlaceHolder/PlaceHolderFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePlaceHolder->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePlaceHolder->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPlaceHolder->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>