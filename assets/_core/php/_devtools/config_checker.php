<?php
	$__CONFIG_ONLY__ = true;
    require_once('../sdev.inc.php');
	require(__QCUBED_CORE__ . '/framework/QInstallationValidator.class.php');



	$arrInstallationMessages = QInstallationValidator::Validate();
	if (sizeof($arrInstallationMessages) == 0) {
		header("Location: start_page.php");
	} else {
        AppSpecificFunctions::CheckRemoteAdmin();
        $strPageTitle = 'sDev Framework - Config Checker';
        require(__CONFIGURATION__ . '/HeaderComponents/standard_header_init.inc.php');

?>
<style>
    body {
        padding-top:0px;
    }
</style>
<div class="container-fluid">
<h1 class="page-header">Let's check your configuration</h1>
<div class="row">
        <div class="col-md-12">
		<p>This simple wizard will help you configure sDev for first use.</p>
	<p>Here's what you need to do:</p>
	<ol>
<?php // Output commands that can help fix these issues
		$commands = "";
		foreach ($arrInstallationMessages as $objResult) {
			if (isset($objResult->strCommandToFix) && strlen($objResult->strCommandToFix) > 0) {
				$commands .= $objResult->strCommandToFix . "\n";
			}
			echo "<li>" . $objResult->strMessage . "</li>\n";
		}
?>
	</ol>
<?php	if (!strtoupper(substr(PHP_OS, 0, 3) == 'WIN') && strlen($commands) > 0) { // On non-windows only, and only if there's at least 1 command to show ?>
	<p>Here are commands that can fix several of these issues:</p>
	<pre><code><?php _p($commands); ?></code></pre>
<?php	} ?>
	<p><button onclick="window.location.reload();" class="btn btn-primary rippleclick">I'm done, continue</button> </p>
	<p><a href="start_page.php">Ignore these warnings and continue</a> (not recommended)</p>
        </div>
</div>
<?php
		require(__CONFIGURATION__ . '/footer.inc.php');
	}
?>