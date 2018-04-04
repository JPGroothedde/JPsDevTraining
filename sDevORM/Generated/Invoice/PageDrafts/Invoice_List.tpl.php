<?php $strPageTitle = 'Invoice List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Invoice/InvoiceModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Invoice List</h3>
        <?php $this->InvoiceList->RenderList();?>
        <?php $this->btnNewInvoice->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>