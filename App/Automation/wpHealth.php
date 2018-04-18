<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 100915
 * Time: 18:58
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require('wp-config.php');
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else
    echo 'All Good!';
?>