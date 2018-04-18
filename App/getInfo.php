<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require('../sdev.inc.php');
if (isset($_GET['auth'])){
    if ($_GET['auth'] != __MAINTENANCEPWD__)
        die('No Authorization');
} else
    die('No Authorization');
echo phpinfo();
?>
