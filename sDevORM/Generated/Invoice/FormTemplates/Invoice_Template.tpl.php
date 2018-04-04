<?php $strPageTitle = 'Invoice Template';?>
<?php require(__CONFIGURATION__ . '/header_form_templates.inc.php');	?>
<style>
    body {
        padding: 0px;
        margin:0px;
    }
</style>
<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/Invoice/InvoiceFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveInvoice->Render();?>
        <!--<?php $this->btnDeleteInvoice->Render();?>
        <?php $this->btnCancelInvoice->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>