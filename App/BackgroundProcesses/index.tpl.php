<?php $strPageTitle = 'BackgroundProcess Overview';

/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessModal.php');?>
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header">My Background Processes</h3>
			<?php $this->BackgroundProcessGrid->RenderGrid();?>
        </div>
    </div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>
	setInterval(updateProcesses, 2000);
	function updateProcesses() {
		qc.pA('BackgroundProcessesForm','act01', 'QClickEvent', '');
    }
</script>
