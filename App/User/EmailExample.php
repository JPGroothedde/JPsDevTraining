<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/04/12
 * Time: 4:38 PM
 */
require('../../sdev.inc.php');

$EmailMessage = new sEmailMessage(array("jp.groothedde@stratusolve.com"),"Email woo","Message html");
if ($EmailMessage->sendMail()) {
    echo "Sent!";
} else
    echo "Not sent...";
?>