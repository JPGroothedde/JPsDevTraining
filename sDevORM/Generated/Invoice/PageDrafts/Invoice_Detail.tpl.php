<?php $strPageTitle = 'Invoice Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Invoice Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Invoice/InvoiceFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveInvoice->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteInvoice->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelInvoice->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>