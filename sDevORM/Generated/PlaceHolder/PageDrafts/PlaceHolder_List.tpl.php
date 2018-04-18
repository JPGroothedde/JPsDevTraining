<?php $strPageTitle = 'PlaceHolder List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PlaceHolder/PlaceHolderModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PlaceHolder List</h3>
        <?php $this->PlaceHolderList->RenderList();?>
        <?php $this->btnNewPlaceHolder->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>