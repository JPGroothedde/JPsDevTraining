<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 310715
 * Time: 10:59
 */
require('../../sdev.inc.php');
if (isset($_GET['auth'])){
    if ($_GET['auth'] != __MAINTENANCEPWD__)
        die('No Authorization');
} else
    die('No Authorization');
$result = array("AppSizeInBytes" => QApplication::getAppSizeInBytes(),
    "AppSizeInMB" => round(QApplication::getAppSizeInBytes()/(1024*1024),6),
    "PrintFriendly" => QApplication::getSizeSymbolByQuantity(QApplication::getAppSizeInBytes()));
echo json_encode($result);
?>