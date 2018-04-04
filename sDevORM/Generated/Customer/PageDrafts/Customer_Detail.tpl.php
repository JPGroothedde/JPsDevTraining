<?php $strPageTitle = 'Customer Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Customer Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Customer/CustomerFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveCustomer->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteCustomer->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelCustomer->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>