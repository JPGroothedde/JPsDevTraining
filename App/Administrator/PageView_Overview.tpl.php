<?php $strPageTitle = 'PageView Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PageView/PageViewModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PageView Overview</h3>
        <?php $this->btnNewPageView->Render();?>
        <?php $this->PageViewGrid->RenderGrid();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>