<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 24012017
 * Time: 11:04
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */

require('../../../sdev.inc.php');
if (!isset($_GET['f']))
    die('No file specified');
$delay = 5;
if (isset($_GET['d']))
    $delay = $_GET['d'];
if (file_exists($_GET['f'])) {
    sleep($delay);
    unlink($_GET['f']);
}
else
    die('No file found');
?>