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
//AppSpecificFunctions::CheckRemoteAdmin();
$dM = new DataModel();
$newDelta = json_encode($dM);
if (isset($_POST['delta'])) {
    $newDelta = $_POST['delta'];
}
//TODO: This is where we would actually update the data model
echo $newDelta;
?>