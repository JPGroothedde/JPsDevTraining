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
    <li <?php echo $PageSubSectionName == 'Test1'?'class="active"':'';?>><a href="#"><i class="fa fa-users" aria-hidden="true"></i></a></li>
    <li <?php echo $PageSubSectionName == 'Test2'?'class="active"':'';?>><a href="#"><i class="fa fa-users" aria-hidden="true"></i></a></li>
    <li <?php echo $PageSubSectionName == 'Test3'?'class="active"':'';?>><a href="#"><i class="fa fa-users" aria-hidden="true"></i></a></li>
    <li <?php echo $PageSubSectionName == 'Test4'?'class="active"':'';?>>
        <a href="javascript:;" data-toggle="collapse" data-target="#collapse_b"><i class="fa fa-users"></i> <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="collapse_b" class="nav sub-nav collapse">
            <li>
                <a href="#"><i class="fa fa-users"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i></a>
            </li>
        </ul>
    </li>
</ul>
