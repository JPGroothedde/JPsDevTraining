<?php $strPageTitle = 'Product Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Product Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Product/ProductFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveProduct->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteProduct->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelProduct->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>