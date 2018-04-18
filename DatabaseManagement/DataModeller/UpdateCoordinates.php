<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 01112016
 * Time: 09:08
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require('../../sdev.inc.php');
$newCoords = '';
if (isset($_POST['coords'])) {
    $newCoords = $_POST['coords'];
}
$DbCoordsFile = fopen(__DOCROOT__.__DBMNG__.'/DataModeller/DataModel_Coordinates.json', "w") or die("Unable to open file!");
fwrite($DbCoordsFile, $newCoords);
fclose($DbCoordsFile);
?>