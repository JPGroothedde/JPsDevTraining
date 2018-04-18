<?php
require('../../sdev.inc.php');
require(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Account_API.class.php');

if (isset($_GET['showdoc'])) {
    include(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/Account_API_Documentation.php');
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
    QQ::Equal(QQN::ApiEntity()->EntityName,'Account')));
if (!$EntityAccess)
    die('No Authorization');
    
include(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Operations/Account_API_Operations.php');
//TODO: Add your own operations below
/*
$Account_Variable = null;
if (isset($_POST['Account_Variable']))
	$Account_Variable = $_POST['Account_Variable'];

switch ($operation) {
	case 'YOUROPERATIONNAME':
		echo yourFunctionName();
		break;
}
function YOUROPERATIONNAME(){
	$AccountAPIInstance = new Account_API();
	$result = $AccountAPIInstance->YOUROPERATIONNAME();
	if (is_array($result)) {
		return json_encode($result);
	}
	return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
 */
?>