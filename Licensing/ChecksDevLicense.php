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
$sN = 'Unknown';
if ($_SERVER['SERVER_NAME'] == 'localhost'){
    $output = '';
    //ipconfig /all
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        exec('ipconfig /all', $output);
    } else {
        exec('ifconfig -a', $output);
    }

    if (sizeof($output) > 0) {
        foreach ($output as $op) {
            if (strpos($op,'ether') !== false) {
                $start = strpos($op,'ether');
                $end = $start+6;
                $sN_Unique = md5('localhost'.substr($op,$end));
                $sN = urlencode($sN_Unique);
                break;
            }
        }
    }
} else
    $sN = urlencode(md5($_SERVER['SERVER_NAME']));
$sUI = urlencode(SDEV_LICENSE);
$sIp = urlencode($_SERVER['SERVER_ADDR']);
$fields = 'ServerUID='.$sUI.'&ServerName='.$sN.'&ServerIP='.$sIp.'&ServerName_Plain='.$_SERVER['SERVER_NAME'];
$resultStr = AppSpecificFunctions::PostToUrl('http://sdev.stratusolve.com/App/Automation/checkLicense.php',$fields);
if (strlen($resultStr) > 0)
    $result = json_decode($resultStr);
else
    AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'/Error/');
if (is_array($result)) {
    if ($result[0] == false){
        $_SESSION['LicenseErrorData'] = $result;
        $_SESSION['sN'] = $sN;
        $_SESSION['sIP'] = $sIp;
        if (isset($_SESSION['DB_Connected']))
            unset($_SESSION['DB_Connected']);
        AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'/Licensing/InvalidLicense/');
    }
} else {
    AppSpecificFunctions::AddCustomLog('Could not check for sDev License. API did not return anything.');
    AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'/Error/');
}
?>