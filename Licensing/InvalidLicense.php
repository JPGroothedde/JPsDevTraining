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
require_once('../sdev.inc.php');
require('../PageControl/pageManager.php');
$sN = '';
$sIp = '';
if (isset($_SESSION['LicenseErrorData'])) {
    $result = $_SESSION['LicenseErrorData'];
    $sN = $_SESSION['sN'];
    $sIp = $_SESSION['sIP'];
    unset($_SESSION['LicenseErrorData']);
    unset($_SESSION['sN']);
    unset($_SESSION['sIP']);
}
else
    $result = null;

$errStr = '';

if (is_array($result)) {
    foreach ($result[1] as $err) {
        $errStr .= '- '.$err.'<br>';
    }
    $errStr .= '<br>To request a license, please email your details to <a href="mailto:info@stratusolve.co">info@stratusolve.co</a> and specify the following:<br>- Server Name: '.urldecode($sN).'<br>- Server IP: '.urldecode($sIp);
} else {
    $errStr .= '<br> There is an unknown issue with your license. Please contact Stratusolve (Pty) Ltd: <a href="mailto:info@stratusolve.co">info@stratusolve.co</a>';
}
    $Message = '<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-danger mrg-top10">
            <div class="panel-heading">Warning!!</div>
            <div class="panel-body">
                <img src="'.AppSpecificFunctions::getAppLogoUrl().'" alt="Logo" class="img-rounded img-responsive mrg-bottom15">
                <p>'.$errStr.'</p>
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

</html>