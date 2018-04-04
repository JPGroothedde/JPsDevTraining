<?php 
if (!class_exists('Account_API'))
	die('No Authorisation');
if (!isset($operation))
	$operation = '';
// Here we will get the post values for each attribute of the Account Object
$AccountId = null;
if (isset($_POST['AccountId']))
    $AccountId = $_POST['AccountId'];
$FullName = null;
if (isset($_POST['FullName']))
    $FullName = $_POST['FullName'];
$FirstName = null;
if (isset($_POST['FirstName']))
    $FirstName = $_POST['FirstName'];
$LastName = null;
if (isset($_POST['LastName']))
    $LastName = $_POST['LastName'];
$EmailAddress = null;
if (isset($_POST['EmailAddress']))
    $EmailAddress = $_POST['EmailAddress'];
$Username = null;
if (isset($_POST['Username']))
    $Username = $_POST['Username'];
$Password = null;
if (isset($_POST['Password']))
    $Password = $_POST['Password'];
$ChangedBy = null;
if (isset($_POST['ChangedBy']))
    $ChangedBy = $_POST['ChangedBy'];
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
        echo getAccount($AccountId);
        break;
    case 'UPDATE':
        echo updateAccount($AccountId);
        break;
    case 'CREATE':
        echo createAccount($AccountId);
        break;
    case 'DELETE':
        echo deleteAccount($AccountId);
        break;
    case 'LIST':
        echo getAccountList();
        break;
}
function getAccount($Id = null){
    $AccountAPIInstance = new Account_API();
    $result = $AccountAPIInstance->getAccount($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function createAccount($Id = null) {
    global $FullName,$FirstName,$LastName,$EmailAddress,$Username,$Password,$ChangedBy,$UserRole_Id;
    $AccountAPIInstance = new Account_API();
    $result = $AccountAPIInstance->createAccount($FullName,$FirstName,$LastName,$EmailAddress,$Username,$Password,$ChangedBy,$UserRole_Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function updateAccount($Id = null) {
    global $FullName,$FirstName,$LastName,$EmailAddress,$Username,$Password,$ChangedBy,$UserRole_Id;
    $AccountAPIInstance = new Account_API();
    $result = $AccountAPIInstance->updateAccount($Id,$FullName,$FirstName,$LastName,$EmailAddress,$Username,$Password,$ChangedBy,$UserRole_Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function deleteAccount($Id = null) {
    $AccountAPIInstance = new Account_API();
    $result = $AccountAPIInstance->deleteAccount($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function getAccountList() {
    global $QueryConditions,$QueryLimit,$QueryOffset;
    $AccountAPIInstance = new Account_API();
    if (!$QueryConditions)
        return json_encode($AccountAPIInstance->getAccountList(null,$QueryLimit,$QueryOffset));
    return json_encode($AccountAPIInstance->getAccountList($QueryConditions,$QueryLimit,$QueryOffset));
}
?>