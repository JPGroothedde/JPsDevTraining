<?php $strPageTitle = 'LineItem List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/LineItem/LineItemModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">LineItem List</h3>
        <?php $this->LineItemList->RenderList();?>
        <?php $this->btnNewLineItem->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>