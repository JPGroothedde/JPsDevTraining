<?php
require('../../sdev.inc.php');
$protocol = 'http://';
if (QApplication::isSecure())
    $protocol = 'https://';
$server = $_SERVER['SERVER_NAME'];
if (isset($_GET['auth'])){
    if (isset($_GET['sql'])) {
        $url = $protocol.$server.__DBMNG__.'/db_restore.php?auth='.$_GET['auth'].'&sql='.$_GET['sql'];
    } else
        die('No backup provided');
} else
    die('No Authorization');

$curl = curl_init();
curl_setopt_array($curl, array(
    // Provide the url to the restore script here
    CURLOPT_URL => $url
));
curl_exec($curl);
curl_close($curl);

?>