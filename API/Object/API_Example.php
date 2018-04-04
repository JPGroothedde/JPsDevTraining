<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 05102016
 * Time: 21:41
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();
$EntityType = 'PlaceHolder';
// POST Example
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw');
$CreateResult = AppSpecificFunctions::CallsDevAPI('CREATE',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo 'Create Result: '.$CreateResult.'<br>';
$resultArray = json_decode($CreateResult);

$createdId = null;
if ($resultArray) {
    if ($resultArray->Result == 'Success') {
        $createdId = $resultArray->ObjId;
        echo 'Created '.$EntityType.' via API with ID: '.$createdId;
    }
}
if (!$createdId)
    die('Cannot continue test. Could not create '.$EntityType);


// GET Example
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw',$EntityType.'Id' => $createdId);
$ReadResult = AppSpecificFunctions::CallsDevAPI('READ',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo '<br><br>Read Result: '.$ReadResult.'<br>';
$resultArray = json_decode($ReadResult);
if ($resultArray) {
    if ($resultArray->Result == 'Success') {
        $obj = $resultArray->Obj;
        echo 'Retrieved '.$EntityType.' via API with ID: '.$obj->Id;
    }
}
// PUT Example
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw',$EntityType.'Id' => $createdId,"DummyThree" => "257");
$UpdateResult = AppSpecificFunctions::CallsDevAPI('UPDATE',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo '<br><br>Update Result: '.$UpdateResult.'<br>';
$resultArray = json_decode($UpdateResult);
if ($resultArray) {
    if ($resultArray->Result == 'Success') {
        echo 'Updated '.$EntityType.' via API with ID: '.$createdId;
    }
}
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw',$EntityType.'Id' => $createdId);
$ReadResult = AppSpecificFunctions::CallsDevAPI('READ',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo '<br>Read Result: '.$ReadResult.'<br>';

// DELETE Example
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw',$EntityType.'Id' => $createdId);
$DeleteResult = AppSpecificFunctions::CallsDevAPI('DELETE',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo '<br><br>Delete Result: '.$DeleteResult.'<br>';
$resultArray = json_decode($DeleteResult);
if ($resultArray) {
    if ($resultArray->Result == 'Success') {
        echo $EntityType.' Deleted!';
    }
}
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw',$EntityType.'Id' => $createdId);
$ReadResult = AppSpecificFunctions::CallsDevAPI('READ',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo '<br>Read Result: '.$ReadResult.'<br>';

//LIST Example
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw');
$ListResult = AppSpecificFunctions::CallsDevAPI('LIST',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo '<br>List All Result: <br>';
$resultArray = json_decode($ListResult);
if ($resultArray) {
    if ($resultArray->Result == 'Success') {
        echo 'Success!<br>';
        foreach ($resultArray->ObjArray as $obj) {
            echo 'Object: '.json_encode($obj).'<br>';
        }
    }
} else {
    echo json_last_error_msg();
}/*
$conditions = array();
//array_push($conditions,array("AND" => ["DummyThree","<",10]));
array_push($conditions,array("AND" => ["DummyThree","is not null"]));
array_push($conditions,array("OR" => ["DummyThree","=",5]));
array_push($conditions,array("OR" => ["DummyThree","=",6]));
array_push($conditions,array("AND" => ["DummyTwo","is null"]));
//The $conditions array will check for PlaceHolder objects where the DummyThree value is 257 or 5 or 6, but will exclude ones where DummyTwo is not null
$data = array("APIKEY" => 'TsGeJSuabt2ZB3WChMOqLE8YkipAHclVP0gxXN574DnfU1m6Rw',"QueryConditions" => $conditions);
$ListResult = AppSpecificFunctions::CallsDevAPI('LIST',AppSpecificFunctions::getBaseUrl().'/API/Object/'.$EntityType.'.php/',$data,'u','p');
echo '<br>List Query Result (Check for PlaceHolder objects where the DummyThree value is 257 or 5 or 6, but exclude ones where the DummyTwo value is not null): <br>';
$resultArray = json_decode($ListResult);
if ($resultArray) {
    if ($resultArray->Result == 'Success') {
        echo 'Success!<br>';
        foreach ($resultArray->ObjArray as $obj) {
            echo 'Object: '.json_encode($obj).'<br>';
        }
    } else {
        if ($resultArray->Message)
            echo $resultArray->Message.'<br>';
    }
} else {
    echo json_last_error_msg();
}*/
?>