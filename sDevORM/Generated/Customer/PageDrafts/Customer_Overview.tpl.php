<?php $strPageTitle = 'Customer Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Customer/CustomerModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Customer Overview</h3>
        <?php $this->CustomerGrid->RenderGrid();?>
        <?php $this->btnNewCustomer->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>