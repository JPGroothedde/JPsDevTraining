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
$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
if ($_SERVER["SERVER_PORT"] != "80")
{
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
}
else
{
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
$currentPageManager = 1;
$currentPage = $pageURL;

// If using url rewrite to get rid of .php extension, ensure that __URL_REWRITE__ is properly defined in config or this file will not work correctly

$currentPageArray = array();
if (isset($_SESSION['currentPageArray'])) {
    $currentPageArray = $_SESSION['currentPageArray'];
    if (count($currentPageArray) > 0){
        if ($currentPageArray[count($currentPageArray)-1] != $currentPage)
            array_push($currentPageArray,$currentPage);
    }else
        array_push($currentPageArray,$currentPage);
    $_SESSION['currentPageArray'] = $currentPageArray;
} else {
    array_push($currentPageArray,__USRMNG__.'/index.php');
    array_push($currentPageArray,$currentPage);
    $_SESSION['currentPageArray'] = $currentPageArray;
}

function loadPreviousPage() {
    if (isset($_SESSION['currentPageArray'])) {
        $currentPageArray_L = array();
        $currentPageArray_L = $_SESSION['currentPageArray'];
        $pageHistoryCount = count($currentPageArray_L);
        if ($pageHistoryCount > 1) {
            $thePreviousPage = $currentPageArray_L[$pageHistoryCount-2];
            array_pop($currentPageArray_L);
            $_SESSION['currentPageArray'] = $currentPageArray_L;
            return $thePreviousPage;
        }
        return __USRMNG__.'/index.php';
    }
    return __USRMNG__.'/index.php';
}

?>
