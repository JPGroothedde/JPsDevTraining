<?php 
if (!class_exists('PlaceHolder_API'))
	die('No Authorisation');
if (!isset($operation))
	$operation = '';
// Here we will get the post values for each attribute of the PlaceHolder Object
$PlaceHolderId = null;
if (isset($_POST['PlaceHolderId']))
    $PlaceHolderId = $_POST['PlaceHolderId'];
$DummyOne = null;
if (isset($_POST['DummyOne']))
    $DummyOne = $_POST['DummyOne'];
$DummyTwo = null;
if (isset($_POST['DummyTwo']))
    $DummyTwo = $_POST['DummyTwo'];
$DummyThree = null;
if (isset($_POST['DummyThree']))
    $DummyThree = $_POST['DummyThree'];
$DummyFour = null;
if (isset($_POST['DummyFour']))
    $DummyFour = $_POST['DummyFour'];
$DummyFive = null;
if (isset($_POST['DummyFive']))
    $DummyFive = $_POST['DummyFive'];
$DummySix = null;
if (isset($_POST['DummySix']))
    $DummySix = $_POST['DummySix'];
$Account_Id = null;
if (isset($_POST['Account_Id']))
    $Account_Id = $_POST['Account_Id'];
$UserRole_Id = null;
if (isset($_POST['UserRole_Id']))
    $UserRole_Id = $_POST['UserRole_Id'];
            
$QueryConditions = null;
if (isset($_POST['QueryConditions']))
    $QueryConditions = $_POST['QueryConditions'];
$QueryLimit = 50;
if (isset($_POST['QueryLimit']))
    $QueryLimit = $_POST['QueryLimit'];
$QueryOffset = 0;
if (isset($_POST['QueryOffset']))
    $QueryOffset = $_POST['QueryOffset'];

switch ($operation) {
    case 'READ':
        echo getPlaceHolder($PlaceHolderId);
        break;
    case 'UPDATE':
        echo updatePlaceHolder($PlaceHolderId);
        break;
    case 'CREATE':
        echo createPlaceHolder($PlaceHolderId);
        break;
    case 'DELETE':
        echo deletePlaceHolder($PlaceHolderId);
        break;
    case 'LIST':
        echo getPlaceHolderList();
        break;
}
function getPlaceHolder($Id = null){
    $PlaceHolderAPIInstance = new PlaceHolder_API();
    $result = $PlaceHolderAPIInstance->getPlaceHolder($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function createPlaceHolder($Id = null) {
    global $DummyOne,$DummyTwo,$DummyThree,$DummyFour,$DummyFive,$DummySix,$Account_Id,$UserRole_Id;
    $PlaceHolderAPIInstance = new PlaceHolder_API();
    $result = $PlaceHolderAPIInstance->createPlaceHolder($DummyOne,$DummyTwo,$DummyThree,$DummyFour,$DummyFive,$DummySix,$Account_Id,$UserRole_Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function updatePlaceHolder($Id = null) {
    global $DummyOne,$DummyTwo,$DummyThree,$DummyFour,$DummyFive,$DummySix,$Account_Id,$UserRole_Id;
    $PlaceHolderAPIInstance = new PlaceHolder_API();
    $result = $PlaceHolderAPIInstance->updatePlaceHolder($Id,$DummyOne,$DummyTwo,$DummyThree,$DummyFour,$DummyFive,$DummySix,$Account_Id,$UserRole_Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function deletePlaceHolder($Id = null) {
    $PlaceHolderAPIInstance = new PlaceHolder_API();
    $result = $PlaceHolderAPIInstance->deletePlaceHolder($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function getPlaceHolderList() {
    global $QueryConditions,$QueryLimit,$QueryOffset;
    $PlaceHolderAPIInstance = new PlaceHolder_API();
    if (!$QueryConditions)
        return json_encode($PlaceHolderAPIInstance->getPlaceHolderList(null,$QueryLimit,$QueryOffset));
    return json_encode($PlaceHolderAPIInstance->getPlaceHolderList($QueryConditions,$QueryLimit,$QueryOffset));
}
?>