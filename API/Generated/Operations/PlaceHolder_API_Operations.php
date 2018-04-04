<?php 
if (!class_exists('PlaceHolder_API'))
	die('No Authorisation');
if (!isset($operation))
	$operation = '';
// Here we will get the post values for each attribute of the PlaceHolder Object
$PlaceHolderId = null;
if (isset($_POST['PlaceHolderId']))
    $PlaceHolderId = $_POST['PlaceHolderId'];
$ = null;
if (isset($_POST['']))
    $ = $_POST[''];
            
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
    global $;
    $PlaceHolderAPIInstance = new PlaceHolder_API();
    $result = $PlaceHolderAPIInstance->createPlaceHolder($);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function updatePlaceHolder($Id = null) {
    global $;
    $PlaceHolderAPIInstance = new PlaceHolder_API();
    $result = $PlaceHolderAPIInstance->updatePlaceHolder($Id,$);
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