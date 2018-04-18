<?php
/**
 * Created by PhpStorm.
 * User: Johan Griesel (Stratusolve (Pty) Ltd)
 * Date: 2017/02/18
 * Time: 10:07 AM
 */

require('../../sdev.inc.php');
if (isset($_GET['auth'])){
	if ($_GET['auth'] != __MAINTENANCEPWD__)
		die('No Authorization');
} else
	die('No Authorization');
echo 'Executing...<br>';
$PId = AppSpecificFunctions::executeBackgroundProcess(__DOCROOT__.__SUBDIRECTORY__.'/App/Automation/ExampleBackgroundScript.php');
if (!$PId) {
	echo 'Something went wrong...';
} else {
	echo 'Process is executing with PId: '.$PId;
}
?>