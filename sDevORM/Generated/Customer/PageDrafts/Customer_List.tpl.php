<?php $strPageTitle = 'Customer List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Customer/CustomerModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Customer List</h3>
        <?php $this->CustomerList->RenderList();?>
        <?php $this->btnNewCustomer->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>