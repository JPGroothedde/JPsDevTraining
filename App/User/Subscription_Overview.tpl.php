<?php $strPageTitle = 'Subscription Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/Subscription/SubscriptionModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Subscription Overview</h3>
        <?php $this->SubscriptionGrid->RenderGrid();?>
        <?php $this->btnNewSubscription->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>