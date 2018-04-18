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
    <li <?php echo $PageSubSectionName == 'Test1'?'class="active"':'';?>><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Test 1</a></li>
    <li <?php echo $PageSubSectionName == 'Test2'?'class="active"':'';?>><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Test 2</a></li>
    <li <?php echo $PageSubSectionName == 'Test3'?'class="active"':'';?>><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Test 3</a></li>
    <li <?php echo $PageSubSectionName == 'Test4'?'class="active"':'';?>>
        <a href="javascript:;" data-toggle="collapse" data-target="#collapse_A"><i class="fa fa-users"></i> Test 4 <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="collapse_A" class="nav sub-nav collapse">
            <li>
                <a href="#">Test 1</a>
            </li>
            <li>
                <a href="#">Test 2</a>
            </li>
        </ul>
    </li>
</ul>
