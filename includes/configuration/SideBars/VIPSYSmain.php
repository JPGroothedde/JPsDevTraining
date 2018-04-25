<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 05122016
 * Time: 21:49
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require_once('../../../sdev.inc.php');
if (!isset($PageSubSectionName))
	$PageSubSectionName = '';
if (isset($_GET['ActiveLabel'])) {
	$PageSubSectionName = $_GET['ActiveLabel'];
}
?>

<ul class="nav">
    <!--li <?php //echo $PageSubSectionName == 'App/User/index'?'class="active"':'';?>><a href="#"><i class="fa fa-gamepad" aria-hidden="true"></i> DASHBOARD</a></li-->
    <li <?php echo $PageSubSectionName == 'Person_Overview'?'class="active"':'';?>><a href="/VIPSYS/App/User/Person_Overview"><i class="fa fa-users" aria-hidden="true"></i> REGISTERED VIPs</a></li>
    
</ul>
<ul class="nav" style="vertical-align: baseline;">
    <li <?php echo $PageSubSectionName == 'Test1'?'class="active"':'';?>><a href="UserManagement/account_edit"><i class="fa fa-cog" aria-hidden="true"></i> SETTINGS</a></li>
    <li <?php echo $PageSubSectionName == 'Test2'?'class="active"':'';?>><a href="#"><i class="fa fa-toggle-off" aria-hidden="true"></i> LOGOUT</a></li>
</ul>