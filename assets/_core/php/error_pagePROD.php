<?php
// Check if we tried to access a remote page without permission
    if (isset($_SESSION['ALLOW_REMOTE_ADMIN_FAILED']))
        AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'/RemoteAccess/');
?>
<html>
<head>
<!--<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrap.min.css");</style>
</head>
<body>
<div class="container">
<div class="row" style="margin-top:50px;">
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="alert alert-danger">Something went wrong here. Please contact the system administrator <a class="btn btn-link" href="<?php echo loadPreviousPage();?>">Go Back</a></div>
</div>
<div class="col-md-4"></div>
</div>
</div>

</body>

<?php

	// Generate the Error Dump
	/*if (!ob_get_level()) { ob_start(); }
	require(__DOCROOT__ . __PHP_ASSETS__ . '/error_dump.php');

	// Do We Log???
	if (defined('ERROR_LOG_PATH') && ERROR_LOG_PATH && defined('ERROR_LOG_FLAG') && ERROR_LOG_FLAG) {
        // Log to File in ERROR_LOG_PATH
        $strContents = ob_get_contents();

        QApplication::MakeDirectory(ERROR_LOG_PATH, 0777);
        $strFileName = ERROR_LOG_PATH . '/' . date('Y-m-d-H-i-s-' . rand(100,999)) . '.html';
        file_put_contents($strFileName, $strContents);
        @chmod($strFileName, 0666);
        AppSpecificFunctions::AddCustomLog($strContents);
    }*/

if (isset($__exc_strType)) {
    $logText = '<br>---------------------------------------------------------<br>'.$__exc_strType . " in file: " . $__exc_strFilename . ", line: " . $__exc_intLineNumber.'<br>
    Message: '.$__exc_strMessage.'<br><strong>Stack Trace: </strong><br>';

    $stack_trace_lines = explode("\n", $__exc_strStackTrace);

    foreach ($stack_trace_lines as $stack_trace_line)
    {
        $logText .= $stack_trace_line.'<br>';

    }
    $logText .= '---------------------------------------------------------';
    AppSpecificFunctions::AddCustomLog($logText);
}
?>
</html>