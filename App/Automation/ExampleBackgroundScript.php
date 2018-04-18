<?php
/**
 * Created by PhpStorm.
 * User: Johan Griesel (Stratusolve (Pty) Ltd)
 * Date: 2017/02/18
 * Time: 10:07 AM
 */
chdir(__DIR__);
require('../../sdev.inc.php');
require(__DOCROOT__.__APP_PHP_ASSETS__.'/BackgroundProcesses/BackgroundProcessManager.php');
$BackgroundProcess = new BackgroundProcessManager($argv);
if (!$BackgroundProcess->initProcess(3900,32)) {
	die(json_encode($BackgroundProcess->ErrorArray));
}
//Do the work that requires some time here...
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Additional POST Data can be retrieved here using $BackgroundProcess->PostData['Index'];
// This is just a silly example showing how to update the process while doing the work
$Start = time();
$SuccessCount = 0;
$MaxMemListSize = 0;
$MaxMem = 0;
for($i=0;$i<50000;$i++) {
	//sleep(5);
	$ListLimit = rand(100,5000);
	$Mem = AppSpecificFunctions::getSizeSymbolByQuantity(memory_get_peak_usage(true));
	$Objects = BackgroundProcessUpdate::QueryArray(QQ::All(),QQ::Clause(QQ::LimitInfo($ListLimit,$i)));
	$ListSize = sizeof($Objects);
	$Duration = time()-$Start;
	$CurrentMem = memory_get_usage(true);
	if ($CurrentMem > $MaxMem) {
		$MaxMemListSize = $ListSize;
		$MaxMem = $CurrentMem;
	}
	$Message = 'Now doing iteration '.$i.';<br>Memory: '.$Mem.';<br>Duration: '.$Duration.'s;<br>List Limit: '.$ListLimit.'
<br>List size: '.$ListSize.'<br>Max memory list size: '.$MaxMemListSize.';Memory: '.AppSpecificFunctions::getSizeSymbolByQuantity($MaxMem);
	if (!$BackgroundProcess->updateProcess_Running($Message)) {
		die(json_encode($BackgroundProcess->ErrorArray));
	}
	$SuccessCount++;
}
if (!$BackgroundProcess->updateProcess_Completed_Successfully('We are done now','Items processed: '.$SuccessCount)) {
	die(json_encode($BackgroundProcess->ErrorArray));
}
//If something fails during the process You can also call:
// $BackgroundProcess->updateProcess_Completed_Failed('Message...');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>