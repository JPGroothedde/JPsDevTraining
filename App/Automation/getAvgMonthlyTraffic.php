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
$last30DaysPageViews = PageView::QueryCount(QQ::AndCondition(QQ::GreaterOrEqual(QQN::PageView()->TimeStamped,QDateTime::Now()->AddDays(-31)),QQ::LessOrEqual(QQN::PageView()->TimeStamped,QDateTime::Now())));
$factor = (QApplication::getAppSizeInBytes()/(1024*1024))/10000;
// Return traffic as MB/month
$estTraffic = ($last30DaysPageViews*$factor);
// To Display nicely
//echo QApplication::getSizeSymbolByQuantity($estTraffic);
$result = array("TrafficInBytes" => $estTraffic*(1024*1024),
    "TrafficInMB" => round($estTraffic,6),
    "PrintFriendly" => QApplication::getSizeSymbolByQuantity($estTraffic*(1024*1024)),
    "NumberOfPageViews" => $last30DaysPageViews,
    "Factor" => $factor);
echo json_encode($result);
?>