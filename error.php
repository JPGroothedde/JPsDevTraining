<?php
require_once('sdev.inc.php');
require('PageControl/pageManager.php');

    $Message = '<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-danger mrg-top10">
            <div class="panel-heading">Warning!!</div>
            <div class="panel-body">
                <img src="'.AppSpecificFunctions::getAppLogoUrl().'" alt="Logo" class="img-rounded img-responsive mrg-bottom15">
                <p>Something went wrong here. Please retry the previous action.<br>If the problem persists, please contact the system administrator</p>
                <a href="'.loadPreviousPage().'" class="btn btn-primary fullWidth">Retry Now</a>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>';

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo __VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__; ?>/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo __VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__; ?>/bootstrapmodifications.css">
</head>
<body>
<?php echo $Message;?>
</body>

<?php
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