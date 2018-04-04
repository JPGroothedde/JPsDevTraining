<?php $strPageTitle = 'Product Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Product/ProductModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Product Overview</h3>
        <?php $this->ProductGrid->RenderGrid();?>
        <?php $this->btnNewProduct->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>