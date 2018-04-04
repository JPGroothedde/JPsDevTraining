<?php
require('../../sdev.inc.php');
$protocol = 'http://';
if (QApplication::isSecure())
    $protocol = 'https://';
$server = $_SERVER['SERVER_NAME'];
if (isset($_GET['auth'])){
    if (isset($_GET['f']))
        $url = $protocol.$server.__DBMNG__.'/db_backup.php?auth='.$_GET['auth'].'&f='.$_GET['f'];
    else
        $url = $protocol.$server.__DBMNG__.'/db_backup.php?auth='.$_GET['auth'];
} else
    die('No Authorization');
//echo $url;

$curl = curl_init();
curl_setopt_array($curl, array(
    // Provide the url to the backup script here
    CURLOPT_URL => $url
));
curl_exec($curl);
curl_close($curl);

?>