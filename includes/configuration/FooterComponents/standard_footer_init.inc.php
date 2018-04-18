<?php
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
</div><!--Container-->
</div><!--Wrapper-->
<footer>
<?php require('standard_scripts.php');?>
<?php require('additional_footer_inits.inc.php'); ?>
<?php
// Create PageView Entry
set_error_handler(function($errno, $errstr) {
	/* ignore errors */
	echo 'An error occured while trying to log the current page view. The class PageView might not exist. Please run the code generator.<br>Error: '.$errstr;
});
$newPageView = new PageView();
$newPageView->TimeStamped = QDateTime::Now();
$newPageView->IPAddress = $_SERVER['REMOTE_ADDR'];
$newPageView->PageDetails = $_SERVER['REQUEST_URI'];
$newPageView->UserAgentDetails = '';
if (array_key_exists('OS', $_SERVER))
	$newPageView->UserAgentDetails .= 'Operating System: '.$_SERVER['OS'].' <br>';
$newPageView->UserAgentDetails .= 'Application: '.$_SERVER['SERVER_SOFTWARE'].' <br>';
$newPageView->UserAgentDetails .= 'Server Name: '.$_SERVER['SERVER_NAME'].' <br>';
$newPageView->UserAgentDetails .= 'HTTP User Agent: '.$_SERVER['HTTP_USER_AGENT'].' <br>';
$newPageView->Username = 'Anonymous';
$newPageView->UserRole = 'Anonymous';
$currentUser = getCurrentAccount();
if ($currentUser) {
	$newPageView->Username = $currentUser->Username;
	$newPageView->UserRole = $currentUser->UserRoleObject->Role;
}
try {
	$newPageView->Save();
} catch (QCallerException $e) {

}
restore_error_handler();

if (class_exists('BackgroundProcess')) {
	$UserId = -1;
	if (is_numeric(AppSpecificFunctions::getCurrentAccountAttribute())) {
		$UserId = AppSpecificFunctions::getCurrentAccountAttribute();
	}
	if ($UserId > 0) {
		$js = '';
		$Bp_Url = AppSpecificFunctions::getBaseUrl().'/App/BackgroundProcesses';
		$HasRunningBackgroundProcess = BackgroundProcess::QueryCount(QQ::AndCondition(QQ::Equal(QQN::BackgroundProcess()->UserId,$UserId),QQ::Like(QQN::BackgroundProcess()->Status,'%Running%')));
		if ($HasRunningBackgroundProcess > 0) {
			
			$AllProcesses = BackgroundProcess::QueryArray(QQ::AndCondition(QQ::Equal(QQN::BackgroundProcess()->UserId,$UserId),QQ::Like(QQN::BackgroundProcess()->Status,'%Running%')));
			foreach ($AllProcesses as $process) {
				addSSEListener($process);
			}
			
		} else {
			// Check if a process finished in the last 30 seconds and if so, also add
			//TODO: Rethink this and implement properly later
			/*
			$Recent = QDateTime::Now()->AddSeconds(-5);
			$RecentProcess = BackgroundProcess::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::BackgroundProcess()->UserId,$UserId),QQ::Like(QQN::BackgroundProcess()->Status,'%Completed%'),
				QQ::GreaterOrEqual(QQN::BackgroundProcess()->UpdateDateTime,$Recent)));
			if ($RecentProcess) {
				addSSEListener($RecentProcess);
			}*/
		}
	}
}

function addSSEListener(BackgroundProcess $Process = null) {
	if (!$Process)
		return;
	$Bp_Url = AppSpecificFunctions::getBaseUrl().'/App/BackgroundProcesses';
	$FinalUrl = (AppSpecificFunctions::getBaseUrl().'/App/BackgroundProcesses/ServerSentEvent.php?bp_url='.$Bp_Url.'&pid='.$Process->PId);
	$js = '<script>
                var source_'.$Process->PId.' = new EventSource(\''.$FinalUrl.'\');
                source_'.$Process->PId.'.addEventListener(\'message\', function(event) {
                  var SSEData_'.$Process->PId.' = JSON.parse(event.data);
                  if (SSEData_'.$Process->PId.'.msg == "COMPLETED") {
                    source_'.$Process->PId.'.close();
                    ShowNotedFeedback(\'Background process completed. <a href="'.AppSpecificFunctions::getBaseUrl().'/App/BackgroundProcesses/">VIEW</a>\',true,false);
                  }
                }, false);
            </script>';
	echo $js;
}

?>
<script>
    function onFileUploaded(formId,actionId) {
        qc.pA(formId,actionId, "QClickEvent", "1", null);
    };
    function executeFormAction(formId,actionId,parameter) {
        qc.pA(formId,actionId, "QClickEvent", parameter, null);
    };
</script>
</footer>
</body>
</html>