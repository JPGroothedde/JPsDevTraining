<?php 
if (!class_exists('UserRole_API'))
	die('No Authorisation');
if (!isset($operation))
	$operation = '';
// Here we will get the post values for each attribute of the UserRole Object
$UserRoleId = null;
if (isset($_POST['UserRoleId']))
    $UserRoleId = $_POST['UserRoleId'];
$Role = null;
if (isset($_POST['Role']))
    $Role = $_POST['Role'];
            
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
        echo getUserRole($UserRoleId);
        break;
    case 'UPDATE':
        echo updateUserRole($UserRoleId);
        break;
    case 'CREATE':
        echo createUserRole($UserRoleId);
        break;
    case 'DELETE':
        echo deleteUserRole($UserRoleId);
        break;
    case 'LIST':
        echo getUserRoleList();
        break;
}
function getUserRole($Id = null){
    $UserRoleAPIInstance = new UserRole_API();
    $result = $UserRoleAPIInstance->getUserRole($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function createUserRole($Id = null) {
    global $Role;
    $UserRoleAPIInstance = new UserRole_API();
    $result = $UserRoleAPIInstance->createUserRole($Role);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function updateUserRole($Id = null) {
    global $Role;
    $UserRoleAPIInstance = new UserRole_API();
    $result = $UserRoleAPIInstance->updateUserRole($Id,$Role);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function deleteUserRole($Id = null) {
    $UserRoleAPIInstance = new UserRole_API();
    $result = $UserRoleAPIInstance->deleteUserRole($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function getUserRoleList() {
    global $QueryConditions,$QueryLimit,$QueryOffset;
    $UserRoleAPIInstance = new UserRole_API();
    if (!$QueryConditions)
        return json_encode($UserRoleAPIInstance->getUserRoleList(null,$QueryLimit,$QueryOffset));
    return json_encode($UserRoleAPIInstance->getUserRoleList($QueryConditions,$QueryLimit,$QueryOffset));
}
?>