<?php
require('../../sdev.inc.php');
require(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/PlaceHolder_API.class.php');

if (isset($_GET['showdoc'])) {
    include(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/PlaceHolder_API_Documentation.php');
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
    QQ::Equal(QQN::ApiEntity()->EntityName,'PlaceHolder')));
if (!$EntityAccess)
    die('No Authorization');
    
include(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Operations/PlaceHolder_API_Operations.php');
//TODO: Add your own operations below
/*
$PlaceHolder_Variable = null;
if (isset($_POST['PlaceHolder_Variable']))
	$PlaceHolder_Variable = $_POST['PlaceHolder_Variable'];

switch ($operation) {
	case 'YOUROPERATIONNAME':
		echo yourFunctionName();
		break;
}
function YOUROPERATIONNAME(){
	$PlaceHolderAPIInstance = new PlaceHolder_API();
	$result = $PlaceHolderAPIInstance->YOUROPERATIONNAME();
	if (is_array($result)) {
		return json_encode($result);
	}
	return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
 */
?>