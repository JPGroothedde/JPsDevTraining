<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 01062016
 * Time: 16:26
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 * This script expects a single table to be exported as csv
 */
require('../../sdev.inc.php');
include_once('../../assets/php/simple_html_dom.php');
if (isset($_SESSION['TableToExport'])) {
    $tableData = urldecode($_SESSION['TableToExport']);
} else
    die("No data found!");
if (isset($_SESSION['CSVFilename'])) {
    $fileName = urldecode($_SESSION['CSVFilename']).'.csv';
} else
    $fileName = 'exported_csv_file.csv';
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$fileName.'"');
$cleanTableData = str_replace('<span class="glyphicon glyphicon-sort-by-attributes pull-right"></span>','',$tableData);
$cleanTableData = str_replace('<i class="fa fa-sort-amount-desc" aria-hidden="true"></i>','',$tableData);
$html = str_get_html($cleanTableData);

$data = '';
// Get the rows
foreach($html->find('tr') as $element) {
	$firstTD = true;
	foreach( $element->find('th') as $row) {
		$plainText = trim($row->plaintext);
		$plainText = str_replace("\r"," ",$plainText);
		$plainText = str_replace("\n"," ",$plainText);
		if (!$firstTD)
			$data .= '"'.$plainText.'",';
		else {
			$data .= $plainText.',';
			$firstTD = false;
		}
	}
    $firstTD = true;
    foreach( $element->find('td') as $row) {
        $plainText = trim($row->plaintext);
        $plainText = str_replace("\r"," ",$plainText);
        $plainText = str_replace("\n"," ",$plainText);
        if (!$firstTD)
            $data .= '"'.$plainText.'",';
        else {
            $data .= $plainText.',';
            $firstTD = false;
        }
    }
    $data = substr($data,0,strlen($data)-1);
    $data .= "\r\n";
}
$output = fopen("php://output", "w");
fputs($output,$data);
fclose($output);

?>


