<?php $strPageTitle = 'BackgroundProcess Overview';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Background Process Overview</h3>
        <?php $this->BackgroundProcessGrid->RenderGrid();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>
	setInterval(updateProcesses, 2000);
	function updateProcesses() {
		qc.pA('BackgroundProcess_OverviewForm','act01', 'QClickEvent', '');
	}
</script>
