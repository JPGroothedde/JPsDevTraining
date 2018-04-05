<?php $strPageTitle = 'Subscription List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Subscription/SubscriptionModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Subscription List</h3>
        <?php $this->SubscriptionList->RenderList();?>
        <?php $this->btnNewSubscription->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>