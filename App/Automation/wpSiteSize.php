<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 15042016
 * Time: 12:36
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require('wp-config.php');

function getFolderSize($path) {
    $total_size = 0;
    $files = scandir($path);
    $cleanPath = rtrim($path, '/'). '/';

    foreach($files as $t) {
        if ($t<>"." && $t<>"..") {
            $currentFile = $cleanPath . $t;
            if (is_dir($currentFile)) {
                $size = getFolderSize($currentFile);
                $total_size += $size;
            }
            else {
                $size = filesize($currentFile);
                $total_size += $size;
            }
        }
    }

    return $total_size;
}

function getDatabaseSizeInBytes($dbLink,$dbName) {
    mysqli_select_db($dbLink,"$dbName");
    $q = mysqli_query($dbLink,"SHOW TABLE STATUS");
    $size = 0;
    while($row = mysqli_fetch_array($q)) {
        $size += $row["Data_length"] + $row["Index_length"];
    }
    return $size;
}
function getSiteSizeInBytes($dbLink,$dbName) {
    return getFolderSize("wp-content")+getDatabaseSizeInBytes($dbLink,$dbName);
}
function getSizeSymbolByQuantity($bytes) {
    $symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
    $exp = floor(log($bytes)/log(1024));

    return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
}


$result = array("AppSizeInBytes" => getSiteSizeInBytes(mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME),DB_NAME),
    "AppSizeInMB" => round(getSiteSizeInBytes(mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME),DB_NAME)/(1024*1024),6),
    "PrintFriendly" => getSizeSymbolByQuantity(getSiteSizeInBytes(mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME),DB_NAME)));
echo json_encode($result);
?>