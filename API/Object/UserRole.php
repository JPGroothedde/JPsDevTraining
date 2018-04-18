<?php
require('../../sdev.inc.php');
require(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/UserRole_API.class.php');

if (isset($_GET['showdoc'])) {
    include(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/UserRole_API_Documentation.php');
    die();
}

if (!isset($_POST['OPERATION']))
    die('Invalid operation');
$operation = $_POST['OPERATION'];
if (!isset($_POST['APIKEY']))
    die('Invalid API Key');
$ApiKey = $_POST['APIKEY'];
$checkApiKey = ApiKey::LoadByApiKey($ApiKey);
if (!$checkApiKey)
    die('Invalid API Key');
if (!($checkApiKey->Status == 'Active'))
    die('Invalid API Key');
    
// This is where we check if the api key has access to THIS entity
$EntityAccess = ApiEntity::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::ApiEntity()->ApiKeyObject->Id,$checkApiKey->Id),
    QQ::Equal(QQN::ApiEntity()->EntityName,'UserRole')));
if (!$EntityAccess)
    die('No Authorization');
    
include(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Operations/UserRole_API_Operations.php');
//TODO: Add your own operations below
/*
$UserRole_Variable = null;
if (isset($_POST['UserRole_Variable']))
	$UserRole_Variable = $_POST['UserRole_Variable'];

switch ($operation) {
	case 'YOUROPERATIONNAME':
		echo yourFunctionName();
		break;
}
function YOUROPERATIONNAME(){
	$UserRoleAPIInstance = new UserRole_API();
	$result = $UserRoleAPIInstance->YOUROPERATIONNAME();
	if (is_array($result)) {
		return json_encode($result);
	}
	return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
 */
?>