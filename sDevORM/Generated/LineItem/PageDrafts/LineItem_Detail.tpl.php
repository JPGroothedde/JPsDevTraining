<?php $strPageTitle = 'LineItem Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">LineItem Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/LineItem/LineItemFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSaveLineItem->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeleteLineItem->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelLineItem->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>