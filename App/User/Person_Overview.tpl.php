<?php $strPageTitle = 'Person Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header">Registered VIPs</h3>
        <?php $this->PersonGrid->RenderGrid();?>
        <?php $this->btnNewPerson->Render();?>
    </div>
</div>
<?php require(__SDEV_ORM__.'/Implementations/Person/PersonModal.php');?>
<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>addSideBar('LEFT','250','','','','','','','','','VIPSYSmain','',<?php echo AppSpecificFunctions::GetDeviceType() == 'phone' ? 'true':'false';?>)</script>
