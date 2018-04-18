<?php
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
set_time_limit(7200); // This script could take some time to run...
require('../sdev.inc.php');
require(__DOCROOT__.__SUBDIRECTORY__.'/Licensing/ChecksDevLicense.php');
require(__SDEV_ORM__.'/sDev_CodeGenerator/sDev_CodeGenerator.class.php');

AppSpecificFunctions::CheckRemoteAdmin();

class sDevORMGenerationForm extends QForm {
    protected $dataModel;
    protected $sh_Overview;

    protected $GenerateStatus = array();

    protected $btnDoGenerate,$btnDoAPIGenerate,$btnDone;
    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->InitGeneration();
    }
    protected function InitGeneration() {
        $this->dataModel = new DataModel();
        $this->dataModel->objects;
        foreach ($this->dataModel->objects as $obj) {
            array_push($this->GenerateStatus, 'To be Generated');
        }
        $this->sh_Overview = new SimpleHTML($this);
        $this->sh_Overview->updateControl($this->GetOverview());

        $this->btnDoGenerate = new QButton($this);
        $this->btnDoGenerate->Text = 'Generate sDev ORM Files';
        $this->btnDoGenerate->CssClass = 'btn btn-primary fullWidth rippleclick';
        $this->btnDoGenerate->AddAction(new QClickEvent(), new QAjaxAction('btnDoGenerate_Clicked'));

        $this->btnDoAPIGenerate = new QButton($this);
        $this->btnDoAPIGenerate->Text = 'Generate sDev API Files';
        $this->btnDoAPIGenerate->CssClass = 'btn btn-primary fullWidth rippleclick';
        $this->btnDoAPIGenerate->AddAction(new QClickEvent(), new QAjaxAction('btnDoAPIGenerate_Clicked'));

        $this->btnDone = new QButton($this);
        $this->btnDone->Text = 'Done';
        $this->btnDone->CssClass = 'btn btn-success fullWidth rippleclick';
        $this->btnDone->AddAction(new QClickEvent(), new QAjaxAction('btnDone_Clicked'));
    }

    protected function btnDone_Clicked() {
        AppSpecificFunctions::Redirect(__VIRTUAL_DIRECTORY__ . __DEVTOOLS__.'/start_page.php');
    }
    protected function btnDoGenerate_Clicked($strFormId, $strControlId, $strParameter) {
        sDev_CodeGenerator::Run(__SDEV_ORM__ . '/sDev_CodeGenerator/codegen_settings.xml');

        $codegenResult = ' <strong>Code Generated:</strong> '.date('l, F j Y, g:i:s A').'
        <h3 class="page-header">Database ORM Generation</h3>
        <div>';
        if ($strErrors = sDev_CodeGenerator::$RootErrors) {
            $codegenResult .= '<p><strong>The following root errors were reported:</strong></p>
            <pre><code>'.$this->DisplayMonospacedText($strErrors).'</code></pre>';
        } else {
            //Do Nothing
        }
        foreach (sDev_CodeGenerator::$CodeGenArray as $objCodeGen) {
            $codegenResult .= '<p><strong>'.$objCodeGen->GetTitle().'</strong></p>
                <p class="code_title">'.$objCodeGen->GetReportLabel().'</p>
                '.$this->DisplayMonospacedText($objCodeGen->GenerateAll());
            if ($strErrors = $objCodeGen->Errors) {
                $codegenResult .= '<p class="code_title">The following errors were reported:</p>
                    '.$this->DisplayMonospacedText($objCodeGen->Errors);
            }

        }
        foreach (sDev_CodeGenerator::GenerateAggregate() as $strMessage) {
            $codegenResult .= '<p><strong>'.$strMessage.'</strong></p>';
        }

        $codegenResult .= '</div>';
        //$codegenResult = AppSpecificFunctions::PostToUrl(AppSpecificFunctions::getBaseUrl().'/sDevORM/sDev_CodeGenerator/codegen.php/');
        //$codegenResult = '';
        $this->GenerateStatus = array();
        foreach ($this->dataModel->objects as $obj) {
            // ORM
            $this->createControllerFile($obj);
            $this->createFrontEndContentFile($obj);
            $this->createFrontEndModalFile($obj);

            // Pages
            $this->createPageBackEndDraftOverviewFile($obj);
            $this->createPageFrontEndDraftOverviewFile($obj);
            $this->createPageBackEndDraftDetailFile($obj);
            $this->createPageFrontEndDraftDetailFile($obj);

            $this->createPageBackEndFormTemplateDraftFile($obj);
            $this->createPageFrontEndFormTemplateDraftFile($obj);
            $this->createPageBackEndFormTemplateFile($obj);
            $this->createPageFrontEndFormTemplateFile($obj);

            array_push($this->GenerateStatus,'Generated Successfully');
        }
        $this->btnDoGenerate->Text = 'Generate sDev ORM Files';
        $this->btnDoGenerate->Enabled = true;
        $this->btnDoGenerate->Refresh();
        $this->sh_Overview->updateControl('<br>'.$codegenResult.'<br><h3 class="page-header">sDev Controllers, Drafts & Templates</h3>'.$this->GetOverview());
    }
    protected function DisplayMonospacedText($strText) {
        $strText = QApplication::HtmlEntities($strText);
        $strText = str_replace('	', '    ', $strText);
        $strText = str_replace(' ', '&nbsp;', $strText);
        $strText = str_replace("\r", '', $strText);
        $strText = str_replace("\n", '<br/>', $strText);

        return $strText;
    }

    protected function btnDoAPIGenerate_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GenerateStatus = array();
        foreach ($this->dataModel->objectAPIs as $obj) {
            $this->createObjectBaseClassAPIs($obj);
            $this->createObjectImplementationClassAPIs($obj);
            $this->createObjectBaseAPIDocumentation($obj);
            $this->createObjectAPIDocumentation($obj);
            $this->createObjectAPIOperations($obj);
            $this->createObjectAPIs($obj);

            array_push($this->GenerateStatus,'Generated Successfully');
        }
        $this->btnDoAPIGenerate->Text = 'Generate sDev API Files';
        $this->btnDoAPIGenerate->Enabled = true;
        $this->btnDoAPIGenerate->Refresh();
        $this->sh_Overview->updateControl('<h3 class="page-header">sDev API Generation:</h3>'.$this->GetAPIOverview());
    }
    protected function GetOverview() {
        $i = 0;
        $html = '<table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                Object
                           </th>
                           <th>
                                Attributes
                           </th>
                           <th>
                                Status
                           </th>
                        </tr>
                    </thead>';
        foreach ($this->dataModel->objects as $obj) {
            $html .= '<tr><td>'.$obj.'</td><td>';
            foreach ($this->dataModel->getObjectAttributes($obj) as $attr) {
                $html .= $attr.', ';
                /*$attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($obj,$attr);
                if (is_array($attrSpecialRender)) {
                    foreach ($attrSpecialRender as $sr){
                        $html .= $sr.'-';
                    }
                }*/
            }
            $html .= '</td><td>'.$this->GenerateStatus[$i].'</td></tr>';
            $i++;
        }
        $html .= '</table>';
        return $html;
    }
    protected function GetAPIOverview() {
        $i = 0;
        $html = '<table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                Object
                           </th>                          
                           <th>
                                Status
                           </th>
                        </tr>
                    </thead>';
        foreach ($this->dataModel->objectAPIs as $obj) {
            $html .= '<tr><td>'.$obj.'</td><td>';
            $html .= '</td><td>'.$this->GenerateStatus[$i].'</td></tr>';
            $i++;
        }
        $html .= '</table>';
        return $html;
    }

    // Generate the API files
    protected function createObjectBaseClassAPIs($objectName) {
        if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/')) {
            mkdir(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/', 0755, true);
        }
        $generatedFile = fopen(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/'.$objectName."_API_Base.class.php", "w") or die("Unable to open file!");
        $code = '<?php
class '.$objectName.'_API_Base {
    public function __construct() {

    }
    public function get'.$objectName.'($'.$objectName.'Id = null) {
        if ($'.$objectName.'Id){
            $the'.$objectName.'Obj = '.$objectName.'::Load($'.$objectName.'Id);
            if ($the'.$objectName.'Obj) {
                $result = array("Result" => "Success","Obj" => json_decode($the'.$objectName.'Obj->getJson()));
                return $result;
            }
            $result = array("Result" => "Success","Obj" => null);
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Invalid Object Id");
        return $result;
    }
    public function create'.$objectName.'(';
        $code .= $this->getAttributeInputParameterList($objectName).') { 
        $new'.$objectName.'Obj = new '.$objectName.'();';
        $code .= $this->getAttributeDeclarationForAPI($objectName);
        $code .= '
        try {
            $new'.$objectName.'Obj->Save();
            $result = array("Result" => "Success","ObjId" => $new'.$objectName.'Obj->Id);
            return $result;
        } catch (QCallerException $e) {
            error_log(\'Could not create '.$objectName.' object via API: \'.$e->getMessage());
            $result = array("Result" => "Failed","Message" => $e->getMessage());
            return $result;
        }
        return null;
    }
    public function update'.$objectName.'($'.$objectName.'Id = null,'.$this->getAttributeInputParameterList($objectName).') {
        if (!$'.$objectName.'Id) {
            $result = array("Result" => "Failed","Message" => "Invalid Object Id");
            return $result;
        }
        $existing'.$objectName.'Obj = '.$objectName.'::Load($'.$objectName.'Id);
        if (!$existing'.$objectName.'Obj) {
            $result = array("Result" => "Failed","Message" => "Object not found");
            return $result;
        }';
        $code .= $this->getAttributeDeclarationForAPI($objectName,'existing');
        $code .= '
        try {
            $existing'.$objectName.'Obj->Save();
            $result = array("Result" => "Success","Message" => "Object Modified");
            return $result;
        } catch (QCallerException $e) {
            error_log(\'Could not update '.$objectName.' object via API: \'.$e->getMessage());
            $result = array("Result" => "Failed","Message" => $e->getMessage());
            return $result;
        }
        return null;
    }
    public function delete'.$objectName.'($'.$objectName.'Id = null) {
        if ($'.$objectName.'Id){
            $the'.$objectName.'Obj = '.$objectName.'::Load($'.$objectName.'Id);
            if ($the'.$objectName.'Obj) {
                $the'.$objectName.'Obj->Delete();
                $result = array("Result" => "Success");
                return $result;
            }
            $result = array("Result" => "Failed","Message" => "Object not found");
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Invalid Object Id");
        return $result;
    }
    
    public function get'.$objectName.'List($QConditions = null,$limit = 50,$offset = 0) {
        if (!$QConditions){
            $'.$objectName.'Array = '.$objectName.'::QueryArray(QQ::All(),QQ::Clause(QQ::LimitInfo($limit,$offset)));
            $returnArray = array();
            foreach ($'.$objectName.'Array as $obj) {
                array_push($returnArray,json_decode($obj->getJson()));
            }
            $result = array("Result" => "Success","ObjArray" => $returnArray);
            return $result;
        } else {
            $queryConditions = null;
            foreach ($QConditions as $condition) {
                if (is_array($condition)) {
                    $andCondition = array_key_exists(\'AND\',$condition);
                    $orCondition = array_key_exists(\'OR\',$condition);
                    if ($andCondition) {
                        $objQueryNode = QQN::'.$objectName.'()->__get($condition[\'AND\'][0]);
                        $strSymbol = $condition[\'AND\'][1];
                        $mixValue = 0;
                        if (isset($condition[\'AND\'][2]))
                            $mixValue = $condition[\'AND\'][2];
                        $mixValueTwo = 0;
                        if (isset($condition[\'AND\'][3]))
                            $mixValueTwo = $condition[\'AND\'][3];
                    } elseif ($orCondition) {
                        $objQueryNode = QQN::'.$objectName.'()->__get($condition[\'OR\'][0]);
                        $strSymbol = $condition[\'OR\'][1];
                        $mixValue = 0;
                        if (isset($condition[\'OR\'][2]))
                            $mixValue = $condition[\'OR\'][2];
                        $mixValueTwo = 0;
                        if (isset($condition[\'OR\'][3]))
                            $mixValueTwo = $condition[\'OR\'][3];
                    } else {
                        $result = array("Result" => "Failed","Message" => "Invalid Compare Symbol");
                        return $result;
                    }
                    try {
                        switch(strtolower(trim($strSymbol))) {
                            case \'=\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::Equal($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'!=\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotEqual($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'>\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::GreaterThan($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'<\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::LessThan($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'>=\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::GreaterOrEqual($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'<=\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::LessOrEqual($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'in\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::In($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'not in\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotIn($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'like\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::Like($objQueryNode, \'%\'.$mixValue.\'%\'),$andCondition,$orCondition);
                                break;
                            case \'not like\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotLike($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'is null\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::IsNull($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'is not null\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::IsNotNull($objQueryNode, $mixValue),$andCondition,$orCondition);
                                break;
                            case \'between\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::Between($objQueryNode, $mixValue, $mixValueTwo),$andCondition,$orCondition);
                                break;
                            case \'not between\': $queryConditions = $this->BuildQueryCondition($queryConditions, QQ::NotBetween($objQueryNode, $mixValue, $mixValueTwo),$andCondition,$orCondition);
                                break;
                            default:
                                throw new QCallerException(\'Unknown Query Comparison Operation: \' . $strSymbol.\'. \'.$this->formatAvailableComparisonSymbols(), 0);
                        }
                    } catch (QCallerException $objExc) {
                        $result = array("Result" => "Failed","Message" => $objExc->getMessage());
                        return $result;
                    }
                }
            }
            $'.$objectName.'Array = '.$objectName.'::QueryArray($queryConditions,QQ::Clause(QQ::LimitInfo($limit,$offset)));

            $returnArray = array();
            foreach ($'.$objectName.'Array as $obj) {
                array_push($returnArray,json_decode($obj->getJson()));
            }
            $result = array("Result" => "Success","ObjArray" => $returnArray);
            return $result;
        }
        $result = array("Result" => "Failed","Message" => "Unknown");
        return $result;
        
    }
    protected function BuildQueryCondition($queryConditionsStart = null,$queryConditionsToAdd = null,$and = false,$or = false) {
        if (!$queryConditionsToAdd)
            return null;
        if (!$queryConditionsStart)
            return $queryConditionsToAdd;
        if ($and) {
            return QQ::AndCondition($queryConditionsStart,$queryConditionsToAdd);
        } elseif ($or) {
            return QQ::OrCondition($queryConditionsStart,$queryConditionsToAdd);
        }
        return $queryConditionsStart;
    }
    protected function formatAvailableComparisonSymbols() {
        return \'Available symbols are: "=", "!=", ">", "<", ">=", "<=", "in", "not in", "like", "not like", "is null", "is not null", "between", "not between"\';
    }
}
?>';
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/'.$objectName."_API_Base.class.php", 0755);
    }
    protected function createObjectImplementationClassAPIs($objectName) {
        if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/'.$objectName.'_API.class.php')) {
            if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/'))
                mkdir(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/', 0755, true);
            $generatedFile = fopen(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/'.$objectName."_API.class.php", "w") or die("Unable to open file!");
            $code = '<?php
require(__DOCROOT__.__SUBDIRECTORY__.\'/API/Generated/'.$objectName.'_API_Base.class.php\');
class '.$objectName.'_API extends '.$objectName.'_API_Base {
    public function __construct() {
        parent::__construct();
    }
}
?>';
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/'.$objectName."_API.class.php", 0755);
        }

    }
	protected function createObjectAPIOperations($objectName) {
		if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Operations/')) {
			mkdir(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Operations/', 0755, true);
		}
		$generatedFile = fopen(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Operations/'.$objectName."_API_Operations.php", "w") or die("Unable to open file!");
		$code = '<?php 
if (!class_exists(\''.$objectName.'_API\'))
	die(\'No Authorisation\');
if (!isset($operation))
	$operation = \'\';
// Here we will get the post values for each attribute of the '.$objectName.' Object
$'.$objectName.'Id = null;
if (isset($_POST[\''.$objectName.'Id\']))
    $'.$objectName.'Id = $_POST[\''.$objectName.'Id\'];';

            foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
	            $code .= '
$'.$attr.' = null;
if (isset($_POST[\''.$attr.'\']))
    $'.$attr.' = $_POST[\''.$attr.'\'];';
            }
            if ($this->dataModel->getObjectSingleRelations($objectName)) {
	            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
		            $code .= '
$'.$attr.'_Id = null;
if (isset($_POST[\''.$attr.'_Id\']))
    $'.$attr.'_Id = $_POST[\''.$attr.'_Id\'];';
	            }
            }
            $code .='
            
$QueryConditions = null;
if (isset($_POST[\'QueryConditions\']))
    $QueryConditions = $_POST[\'QueryConditions\'];
$QueryLimit = 50;
if (isset($_POST[\'QueryLimit\']))
    $QueryLimit = $_POST[\'QueryLimit\'];
$QueryOffset = 0;
if (isset($_POST[\'QueryOffset\']))
    $QueryOffset = $_POST[\'QueryOffset\'];

switch ($operation) {
    case \'READ\':
        echo get'.$objectName.'($'.$objectName.'Id);
        break;
    case \'UPDATE\':
        echo update'.$objectName.'($'.$objectName.'Id);
        break;
    case \'CREATE\':
        echo create'.$objectName.'($'.$objectName.'Id);
        break;
    case \'DELETE\':
        echo delete'.$objectName.'($'.$objectName.'Id);
        break;
    case \'LIST\':
        echo get'.$objectName.'List();
        break;
}
function get'.$objectName.'($Id = null){
    $'.$objectName.'APIInstance = new '.$objectName.'_API();
    $result = $'.$objectName.'APIInstance->get'.$objectName.'($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function create'.$objectName.'($Id = null) {
    global '.$this->getAttributeListForAPI($objectName).';
    $'.$objectName.'APIInstance = new '.$objectName.'_API();
    $result = $'.$objectName.'APIInstance->create'.$objectName.'('.$this->getAttributeListForAPI($objectName).');
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function update'.$objectName.'($Id = null) {
    global '.$this->getAttributeListForAPI($objectName).';
    $'.$objectName.'APIInstance = new '.$objectName.'_API();
    $result = $'.$objectName.'APIInstance->update'.$objectName.'($Id,'.$this->getAttributeListForAPI($objectName).');
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function delete'.$objectName.'($Id = null) {
    $'.$objectName.'APIInstance = new '.$objectName.'_API();
    $result = $'.$objectName.'APIInstance->delete'.$objectName.'($Id);
    if (is_array($result)) {
        return json_encode($result);
    }
    return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
function get'.$objectName.'List() {
    global $QueryConditions,$QueryLimit,$QueryOffset;
    $'.$objectName.'APIInstance = new '.$objectName.'_API();
    if (!$QueryConditions)
        return json_encode($'.$objectName.'APIInstance->get'.$objectName.'List(null,$QueryLimit,$QueryOffset));
    return json_encode($'.$objectName.'APIInstance->get'.$objectName.'List($QueryConditions,$QueryLimit,$QueryOffset));
}
?>';
		fwrite($generatedFile, $code);
		fclose($generatedFile);
		chmod(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Operations/'.$objectName."_API_Operations.php", 0755);
	}
    protected function createObjectBaseAPIDocumentation($objectName) {
        if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Documentation/')) {
            mkdir(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Documentation/', 0755, true);
        }
        $generatedFile = fopen(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Documentation/'.$objectName."_API_Documentation_Base.html", "w") or die("Unable to open file!");
        $code = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>'.$objectName.' API Documentation</title>
</head>
<body>
<h2>Introduction</h2>
<p>This API allows for interaction with the '.$objectName.' object contained in the application ORM. To call this API, the calling application needs to POST the
following minimum parameters:</p >
<ul >
    <li >
        APIKEY -> The API key that allows for access to this API
    </li >
    <li >
        OPERATION -> The operation that is to be performed
    </li >
</ul> 
<hr>
<h2>Implementation</h2>
<h3>Object Definition ('.$objectName.')</h3>
<h5>Object Attributes</h5>
'.json_encode($this->dataModel->getObjectAttributes($objectName)).'
<h5>Object Relationships (Id for each associated object)</h5>
[';
if ($this->dataModel->getObjectSingleRelations($objectName)) {
foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
    $code .= '"'.$attr.'_Id",';
}
$code = substr($code,0,strlen($code)-1);
}
$code .= ']  
<hr>
<h2>Available Operations (CRUD)</h2>
<p>The following base operations are available: (Additional Operations are defined at the bottom of this page)</p>
<ul>
    <li>
        READ
    </li>
    <li>
        UPDATE
    </li>
    <li>
        CREATE
    </li>
    <li>
        DELETE
    </li>
    <li>
        LIST
    </li>
</ul>
<hr>
<h4>READ</h4>
<h5>Input Data (POST FIELDS):</h5>
'.json_encode(array("APIKEY" => "The Provided Api Key", "OPERATION" => "READ", "$objectName"."Id" => "[The Id To Retrieve]")).'
<h5>Expected Result:</h5>
'.json_encode(array("Result" => "Success","Obj" => "[json encoded $objectName"." Object]")).'
<hr>
<h4>UPDATE</h4>
<h5>Input Data (POST FIELDS):</h5>
{"APIKEY":"The Provided Api Key","OPERATION":"UPDATE","'.$objectName.'Id":"[The Id To Update]",';
foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
$code .= '"'.$attr.'":"[new value]",';
}
if ($this->dataModel->getObjectSingleRelations($objectName)) {
foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
    $code .= '"'.$attr.'_Id":"[Id of '.$attr.' Object to associate]",';
}
$code = substr($code,0,strlen($code)-1);
}
$code .= '}
<h5>Expected Result:</h5>
'.json_encode(array("Result" => "Success","Message" => "Object Modified")).'
<hr>
<h4>CREATE</h4>
<h5>Input Data (POST FIELDS):</h5>
{"APIKEY":"The Provided Api Key","OPERATION":"CREATE",';
foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
$code .= '"'.$attr.'":"[new value]",';
}
if ($this->dataModel->getObjectSingleRelations($objectName)) {
foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
    $code .= '"'.$attr.'_Id":"[Id of '.$attr.' Object to associate]",';
}
$code = substr($code,0,strlen($code)-1);
}
$code .= '}
<h5 > Expected Result:</h5>
'.json_encode(array("Result" => "Success","ObjId" => "[Id of newly created object]")).'
<hr>
<h4>DELETE</h4>
<h5>Input Data (POST FIELDS):</h5>
'.json_encode(array("APIKEY" => "The Provided Api Key", "OPERATION" => "DELETE", "$objectName"."Id" => "[The Id To Delete]")).'
<h5>Expected Result:</h5>
'.json_encode(array("Result" => "Success")).'
<hr>
<h4>LIST</h4>
<h5>Input Data (POST FIELDS):</h5>
'.json_encode(array("APIKEY" => "The Provided Api Key", "OPERATION" => "LIST", "QueryConditions" => "[The Query Conditions]")).'
<h5>Expected Result:</h5>
'.json_encode(array("Result" => "Success","ObjArray" => "[Array Of JSON Encoded Objects]")).'
<h4>Example Query Conditions</h4>
<p>array("AND" => ["ObjectAttribute","<",[Value]],"AND" => ["ObjectAttribute","is not null"],"OR" => ["ObjectAttribute","=",[Value]],"AND" => ["ObjectAttribute","is null"])<br>
<h5>All available compare symbols</h5>
"=","!=",">","<",">=","<=","in","not in","like","not like","is null","is not null","between","not between"</p><hr>
<h2>Additional Operations</h2>
None
</body>
</html>';
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod(__DOCROOT__.__SUBDIRECTORY__.'/API/Generated/Documentation/'.$objectName."_API_Documentation_Base.html", 0755);
    }
    protected function createObjectAPIDocumentation($objectName) {
        if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/'.$objectName.'_API_Documentation.php')) {
            if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/'))
                mkdir(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/', 0755, true);
            $generatedFile = fopen(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/'.$objectName."_API_Documentation.php", "w") or die("Unable to open file!");
            $code = '<?php
// Either leave as is or replace with custom documentation
require(\'../../sdev.inc.php\');
include(__DOCROOT__.__SUBDIRECTORY__.\'/API/Generated/Documentation/'.$objectName.'_API_Documentation_Base.html\');
?>';
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod(__DOCROOT__.__SUBDIRECTORY__.'/API/Implementations/Documentation/'.$objectName."_API_Documentation.php", 0755);
        }

    }
    protected function createObjectAPIs($objectName) {
        if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Object/'))
            mkdir(__DOCROOT__.__SUBDIRECTORY__.'/API/Object/', 0755, true);
        if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.'/API/Object/'.$objectName.'.php')) {
            $generatedFile = fopen(__DOCROOT__.__SUBDIRECTORY__.'/API/Object/'.$objectName.".php", "w") or die("Unable to open file!");
            $code = '<?php
require(\'../../sdev.inc.php\');
require(__DOCROOT__.__SUBDIRECTORY__.\'/API/Implementations/'.$objectName.'_API.class.php\');

if (isset($_GET[\'showdoc\'])) {
    include(__DOCROOT__.__SUBDIRECTORY__.\'/API/Implementations/Documentation/'.$objectName.'_API_Documentation.php\');
    die();
}

if (!isset($_POST[\'OPERATION\']))
    die(\'Invalid operation\');
$operation = $_POST[\'OPERATION\'];
if (!isset($_POST[\'APIKEY\']))
    die(\'Invalid API Key\');
$ApiKey = $_POST[\'APIKEY\'];
$checkApiKey = ApiKey::LoadByApiKey($ApiKey);
if (!$checkApiKey)
    die(\'Invalid API Key\');
if (!($checkApiKey->Status == \'Active\'))
    die(\'Invalid API Key\');
    
// This is where we check if the api key has access to THIS entity
$EntityAccess = ApiEntity::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::ApiEntity()->ApiKeyObject->Id,$checkApiKey->Id),
    QQ::Equal(QQN::ApiEntity()->EntityName,\''.$objectName.'\')));
if (!$EntityAccess)
    die(\'No Authorization\');
    
include(__DOCROOT__.__SUBDIRECTORY__.\'/API/Generated/Operations/'.$objectName.'_API_Operations.php\');
//TODO: Add your own operations below
/*
$'.$objectName.'_Variable = null;
if (isset($_POST[\''.$objectName.'_Variable\']))
	$'.$objectName.'_Variable = $_POST[\''.$objectName.'_Variable\'];

switch ($operation) {
	case \'YOUROPERATIONNAME\':
		echo yourFunctionName();
		break;
}
function YOUROPERATIONNAME(){
	$'.$objectName.'APIInstance = new '.$objectName.'_API();
	$result = $'.$objectName.'APIInstance->YOUROPERATIONNAME();
	if (is_array($result)) {
		return json_encode($result);
	}
	return json_encode(array("Result" => "Failed","Message" => "Unknown"));
}
 */
?>';
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod(__DOCROOT__.__SUBDIRECTORY__.'/API/Object/'.$objectName.".php", 0755);
        } else {
            return;
        }
    }
    // Generate the Controller files
    protected function createControllerFile($objectName) {
        if (!file_exists('Generated/'.$objectName)) {
            mkdir('Generated/'.$objectName, 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/'.$objectName."Controller_Base.php", "w") or die("Unable to open file!");
        $code = '<?php
class '.$objectName.'Controller_Base {
    protected $Object;
    ';
        $code .= $this->getControllerVariableDeclarations($objectName).'
    ';
        $code .= $this->getControllerConstructor($objectName).'

    ';
        $code .= $this->createControllerFunction_setObject().'

    ';
        $code .= $this->createControllerFunction_setReferenceListObjectDisplayAttribute($objectName).'

    ';
        $code .= $this->createControllerFunction_setOverrideSaveForReferenceObject($objectName).'

    ';
        $code .= $this->createControllerFunction_setValues($objectName).'

    ';
        $code .= $this->createControllerFunction_setTimeAttr($objectName).'

    ';
        $code .= $this->createControllerFunction_renderControl($objectName).'

    ';
        $code .= $this->createControllerFunction_renderAll($objectName).'

    ';
        $code .= $this->createControllerFunction_getRenderedFrontEnd($objectName).'

    ';
        $code .= $this->createControllerFunction_hideAll($objectName).'

    ';
        $code .= $this->createControllerFunction_showAll($objectName).'

    ';
        $code .= $this->createControllerFunction_refreshAll($objectName).'

    ';
        $code .= $this->createControllerFunction_setValue($objectName).'

    ';
        $code .= $this->createControllerFunction_getValue($objectName).'

    ';
        $code .= $this->createControllerFunction_getControlId($objectName).'

    ';
        $code .= $this->createControllerFunction_hideControl($objectName).'

    ';
        $code .= $this->createControllerFunction_showControl($objectName).'

    ';
        $code .= $this->createControllerFunction_getFocusControlId($objectName).'

    ';
        $code .= $this->createControllerFunction_getObject().'

    ';
        $code .= $this->createControllerFunction_getObjectId().'

    ';
        $code .= $this->createControllerFunction_applyValuesBeforeSaveObject($objectName).'

    ';
        $code .= $this->createControllerFunction_saveObject($objectName).'

    ';
        $code .= $this->createControllerFunction_deleteObject().'

    ';
        $code .= $this->createControllerFunction_validateObject($objectName).'

    ';
        $code .= $this->createControllerFunction_resetValidation($objectName).'

    ';
        $code .= $this->createControllerFunction_saveWithAudit($objectName).'

    ';
        $code .= $this->createControllerFunction_deleteWithAudit($objectName).'

    ';

        $code .= '
};
?>';
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/'.$objectName."Controller_Base.php", 0755);
        $this->createObjectImplementation($objectName);
    }
    protected function createObjectImplementation($objectName) {
        if (!file_exists('Implementations/'.$objectName)) {
            mkdir('Implementations/'.$objectName, 0755, true);
        }
        if (!file_exists('Implementations/'.$objectName.'/'.$objectName."Controller.php")) {
            $generatedFile = fopen('Implementations/'.$objectName.'/'.$objectName."Controller.php", "w") or die("Unable to open file!");
            $code = '<?php
require_once(__SDEV_ORM__.\'/Generated/'.$objectName.'/'.$objectName.'Controller_Base.php\');

class '.$objectName.'Controller extends '.$objectName.'Controller_Base {
    public function __construct($objParentObject,$InitObject = null) {
        parent::__construct($objParentObject,$InitObject);
    }
};
?>';
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod('Implementations/'.$objectName.'/'.$objectName."Controller.php", 0755);
        }
    }
    protected function getControllerVariableDeclarations($objectName) {
        $code = '';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= $this->getAttributeDeclarationString($objectName,$attr);
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= 'public $lst'.$attr.',$saveUsingLst'.$attr.' = false;
    ';
            }
        }

        return $code;
    }
    protected function getControllerConstructor($objectName) {
        $code ='public function __construct($objParentObject,$InitObject = null) {
        ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= $this->getAttributeInitString($objectName,$attr);
            if (($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATE') || ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME')) {
                $code .= '
        '.$this->getAttributeString($objectName,$attr).'->CssClass = \'form-control input-date\';

        ';
                if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                    $code .= '$this->lst'.$attr.'Hours = new QListBox($objParentObject);
        $this->lst'.$attr.'Hours->DisplayStyle = QDisplayStyle::Inline;
        $this->lst'.$attr.'Minutes = new QListBox($objParentObject);
        $this->lst'.$attr.'Minutes->HtmlBefore = \' : \';
        $this->lst'.$attr.'Minutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lst'.$attr.'Hours->AddItem(new QListItem(\'--\',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = \'AM\';
            if ($i>11 && $i < 24)
                $amPm = \'PM\';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lst'.$attr.'Hours->AddItem(new QListItem($display.\' \'.$amPm,$i));
        }
        $this->lst'.$attr.'Minutes->AddItem(new QListItem(\'--\',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = \'0\'.$i;
            $this->lst'.$attr.'Minutes->AddItem(new QListItem($display,$i));
        }
        
        ';
                }

            } elseif (($this->dataModel->getObjectAttributeType($objectName,$attr) == 'INT') || ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'FLOAT')
                || ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'BIGINT')) {
                if (strpos($this->getAttributeString($objectName,$attr),'$this->txt') !== false) {
                    $code .= '
        '.$this->getAttributeString($objectName,$attr).'->TextMode = QTextMode::Number;

        ';
                } else {
                    $code .= '

        ';
                }
            } else {
                $code .= '

        ';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '$this->lst'.$attr.' = new QListBox($objParentObject);
        $this->lst'.$attr.'->Name = \''.$this->getCamelCaseSplitted($attr).'\';
        $this->lst'.$attr.'->AddCssClass(\'fullWidth\');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $all'.$attr.' = '.$attr.'::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($all'.$attr.' as $'.$attr.') {
            $this->lst'.$attr.'->AddItem(new QListItem($'.$attr.'->Id,$'.$attr.'->Id));
        }

        ';
            }
        }
        $code .= 'if ($InitObject)
            $this->Object = $InitObject;
        else
            $this->Object = null;
        $this->setValues($this->Object);';
        $code .='
    }

    ';
        return $code;
    }
    protected function createControllerFunction_setObject() {
        $code ='public function setObject($Object) {
        if ($Object)
            $this->Object = $Object;
        else
            $this->Object = null;
    }';
        return $code;
    }
    protected function createControllerFunction_setReferenceListObjectDisplayAttribute($objectName) {
        $code ='public function setReferenceListObjectDisplayAttribute($ReferenceObject = null,$ReferenceAttribute = null) {
        if ($ReferenceObject && $ReferenceAttribute) {';
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
            if ($ReferenceObject == \''.$attr.'\') {
                $this->lst'.$attr.'->RemoveAllItems();
                $all'.$attr.'_list = '.$attr.'::LoadAll();
                foreach ($all'.$attr.'_list as $'.$attr.') {
                    $this->lst'.$attr.'->AddItem(new QListItem($'.$attr.'->__get($ReferenceAttribute),$'.$attr.'->Id));
                }
            }';
            }
        }
        $code .= '
        }
    }';
        return $code;
    }
    protected function createControllerFunction_setOverrideSaveForReferenceObject($objectName) {
        $code ='public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {';
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
            if ($ReferenceObject == \''.$attr.'\') {
                $this->saveUsingLst'.$attr.' = $useListValue;
            }';
            }
        }
        $code .= '
        }
    }';
        return $code;
    }
    protected function createControllerFunction_setValues($objectName) {
        $code = 'public function setValues($Object) {';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
        '.$this->getAttributeDefaultString($objectName,$attr);
        }
        // TO DO: Fix this to check for empty references before saving
        /*if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        $this->lst'.$attr.'->SelectedIndex = 1;';
            }
        }*/
        $code .= '

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $objectAttrValue = '$Object->'.$attr.'';
            if (($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATE') || ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME'))
                $objectAttrValue = '$Object->'.$attr.'->format(DATE_TIME_FORMAT_HTML)';
            $code .= $this->getAttributeAssignedString($objectName,$attr,$objectAttrValue);
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        if (!is_null($Object->'.$attr.'Object)) {
            $this->lst'.$attr.'->SelectedValue = $Object->'.$attr.'Object->Id;
        }';
            }
        }
        $code .= '

        $this->resetValidation();
        $this->refreshAll();';
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_setTimeAttr($objectName) {
        $code = '';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= 'public function set'.$attr.'Time(QDateTime $time = null) {
        if (!$time) {
            $this->lst'.$attr.'Hours->SelectedIndex = 0;
            $this->lst'.$attr.'Minutes->SelectedIndex = 0;
            return;
        }
        $this->lst'.$attr.'Hours->SelectedValue = $time->format(\'H\');
        $this->lst'.$attr.'Minutes->SelectedValue = $time->format(\'i\');
    }';
            }
        }
        return $code;
    }
    protected function createControllerFunction_setValue($objectName) {
        $code = 'public function setValue($strAttr = \'\',$value = null) {
        switch (strtoupper($strAttr)) {
            case \'\':
                break;
            ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= 'case \''.strtoupper($attr).'\':
                '.$this->getAttributeSetValueString($objectName,$attr).' = $value;
                break;
            ';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= 'case \''.strtoupper($attr).'TIME\':
                $this->set'.$attr.'Time($value);
                break;
            ';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= 'case \''.strtoupper($attr).'\':
                $this->lst'.$attr.'->SelectedValue = $value;
                break;
            ';
            }
        }
        $code .= 'default:
                break;
        }
        return null;
    }
';
        return $code;
    }
    protected function createControllerFunction_getValue($objectName) {
        $code = 'public function getValue($strAttr = \'\') {
        switch (strtoupper($strAttr)) {
            case \'\':
                break;
            ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= 'case \''.strtoupper($attr).'\':
                if ('.$this->getAttributeSetValueString($objectName,$attr).')
                    return '.$this->getAttributeSetValueString($objectName,$attr).';
                break;
            ';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= 'case \''.strtoupper($attr).'TIME\':
                return $this->lst'.$attr.'Hours->SelectedValue.\':\'.$this->lst'.$attr.'Minutes->SelectedValue;
                break;
            ';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= 'case \''.strtoupper($attr).'\':
                if ($this->lst'.$attr.'->SelectedValue)
                    return $this->lst'.$attr.'->SelectedValue;
                break;
            ';
            }
        }
        $code .= 'default:
                break;
        }
        return null;
    }
';
        return $code;
    }
    protected function createControllerFunction_getControlId($objectName) {
        $code = 'public function getControlId($strAttr = \'\') {
        switch (strtoupper($strAttr)) {
            case \'\':
                break;
            ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= 'case \''.strtoupper($attr).'\':
                if ('.$this->getAttributeString($objectName,$attr).')
                    return '.$this->getAttributeString($objectName,$attr).'->ControlId;
                break;
            ';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= 'case \''.strtoupper($attr).'HOURS\':
                if ($this->lst'.$attr.'Hours)
                    return $this->lst'.$attr.'Hours->ControlId;
                break;
            ';
                $code .= 'case \''.strtoupper($attr).'MINUTES\':
                if ($this->lst'.$attr.'Minutes)
                    return $this->lst'.$attr.'Minutes->ControlId;
                break;
            ';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= 'case \''.strtoupper($attr).'\':
                if ($this->lst'.$attr.')
                    return $this->lst'.$attr.'->ControlId;
                break;
            ';
            }
        }
        $code .= 'default:
                break;
        }
        return null;
    }
';
        return $code;
    }
    protected function createControllerFunction_hideControl($objectName) {
        $code = 'public function hideControl($strAttr = \'\') {
        switch (strtoupper($strAttr)) {
            case \'\':
                break;
            ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= 'case \''.strtoupper($attr).'\':
                '.$this->getAttributeString($objectName,$attr).'->Visible = false;
                '.$this->getAttributeString($objectName,$attr).'->Refresh();
                break;
            ';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= 'case \''.strtoupper($attr).'TIME\':
                $this->lst'.$attr.'Hours->Visible = false;
                $this->lst'.$attr.'Minutes->Visible = false;
                $this->lst'.$attr.'Hours->Refresh();
                $this->lst'.$attr.'Minutes->Refresh();
                break;
            ';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= 'case \''.strtoupper($attr).'\':
                $this->lst'.$attr.'->Visible = false;
                $this->lst'.$attr.'->Refresh();
                break;
            ';
            }
        }
        $code .= 'default:
                break;
        }
        return null;
    }
';
        return $code;
    }
    protected function createControllerFunction_showControl($objectName) {
        $code = 'public function showControl($strAttr = \'\') {
        switch (strtoupper($strAttr)) {
            case \'\':
                break;
            ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= 'case \''.strtoupper($attr).'\':
                '.$this->getAttributeString($objectName,$attr).'->Visible = true;
                '.$this->getAttributeString($objectName,$attr).'->Refresh();
                break;
            ';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= 'case \''.strtoupper($attr).'TIME\':
                $this->lst'.$attr.'Hours->Visible = true;
                $this->lst'.$attr.'Minutes->Visible = true;
                $this->lst'.$attr.'Hours->Refresh();
                $this->lst'.$attr.'Minutes->Refresh();
                break;
            ';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= 'case \''.strtoupper($attr).'\':
                $this->lst'.$attr.'->Visible = true;
                $this->lst'.$attr.'->Refresh();
                break;
            ';
            }
        }
        $code .= 'default:
                break;
        }
        return null;
    }
';
        return $code;
    }
    protected function createControllerFunction_refreshAll($objectName) {
        $code = 'public function refreshAll() {';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
        '.$this->getAttributeString($objectName,$attr).'->Refresh();';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= '
        $this->lst'.$attr.'Hours->Refresh();';
                $code .= '
        $this->lst'.$attr.'Minutes->Refresh();';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        $this->lst'.$attr.'->Refresh();';
            }
        }
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_renderControl($objectName) {
        $code = 'public function renderControl($strControl = \'\',$withName = true,$nameValue = \'\',$blnPrintOutput = true) {
        $output = \'\';
        ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= 'if (strtoupper($strControl) == \''.strtoupper($attr).'\') {
            if (strlen($nameValue) > 0)
                '.$this->getAttributeString($objectName,$attr).'->Name = $nameValue;
            $output = $withName ? '.$this->getAttributeString($objectName,$attr).'->RenderWithName($blnPrintOutput):'.$this->getAttributeString($objectName,$attr).'->Render($blnPrintOutput);
        }
        ';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= 'if (strtoupper($strControl) == \''.strtoupper($attr).'TIME\') {
            if ($withName) {
                $this->lst'.$attr.'Hours->HtmlBefore = \'<label style="display:block;">\'.$nameValue.\'</label>\';
            } else {
                $this->lst'.$attr.'Hours->HtmlBefore = \'\';
            }
            $output = $this->lst'.$attr.'Hours->Render($blnPrintOutput);
            $output .= $this->lst'.$attr.'Minutes->Render($blnPrintOutput);
        }
        ';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= 'if (strtoupper($strControl) == \''.strtoupper($attr).'\') {
            if (strlen($nameValue) > 0)
                $this->lst'.$attr.'->Name = $nameValue;
            $output = $withName ? $this->lst'.$attr.'->RenderWithName($blnPrintOutput):$this->lst'.$attr.'->Render($blnPrintOutput);
        }
        ';
            }
        }
        $code .= '
        return $output;
    }';
        return $code;
    }
    protected function createControllerFunction_hideAll($objectName) {
        $code = 'public function hideAll() {';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
        '.$this->getAttributeString($objectName,$attr).'->Visible = false;';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= '
        $this->lst'.$attr.'Hours->Visible = false;';
                $code .= '
        $this->lst'.$attr.'Minutes->Visible = false;';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        $this->lst'.$attr.'->Visible = false;';
            }
        }
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_showAll($objectName) {
        $code = 'public function showAll() {';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
        '.$this->getAttributeString($objectName,$attr).'->Visible = true;';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= '
        $this->lst'.$attr.'Hours->Visible = true;';
                $code .= '
        $this->lst'.$attr.'Minutes->Visible = true;';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        $this->lst'.$attr.'->Visible = true;';
            }
        }
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_renderAll($objectName) {
        $code = 'public function renderAll($withName = true)  {';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
        $this->renderControl(\''.strtoupper($attr).'\',$withName);';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= '
        $this->renderControl(\''.strtoupper($attr).'TIME\',$withName);';
            }
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        $this->renderControl(\''.strtoupper($attr).'\',$withName);';
            }
        }
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_getRenderedFrontEnd($objectName) {
        $code = 'public function getRenderedFrontEnd($withName = true)  {';
        $code .= '
        $html = \'<div class="row">';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
                <div class="col-md-6">
                   \'.$this->renderControl(\''.$attr.'\',$withName, null, false).\'
                </div>';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= '
                <div class="col-md-6">
                   \'.$this->renderControl(\''.$attr.'TIME\',$withName, \'Time\', false).\'
                </div>';
            }
        }
        $code .='
            </div>\';
        return $html;';
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_getObject() {
        $code ='public function getObject () {
        return $this->Object;
    }';
        return $code;
    }
    protected function createControllerFunction_getObjectId() {
        $code ='public function getObjectId() {
        if ($this->Object)
            return $this->Object->Id;
        else
            return -1;
    }';
        return $code;
    }
    protected function createControllerFunction_getFocusControlId($objectName) {
        $code = 'public function getFocusControlId() {';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
        return '.$this->getAttributeString($objectName,$attr).'->getJqControlId();';
            break;
        }
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_saveObject($objectName) {
        $refList = '';
        $refPassList = '';
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $refList .= ',$' . $attr . ' = null';
                if (strlen($refPassList) > 0)
                    $refPassList .= ',$'.$attr;
                else
                    $refPassList .= '$'.$attr;
            }
        }
        $code = 'public function saveObject($validate = true'.$refList.')  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }';
        $code .= '
        $this->applyValuesBeforeSaveObject('.$refPassList.');
        ';
        $code .= '
        return $this->saveWithAudit();';
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_applyValuesBeforeSaveObject($objectName) {
        $refList = '';
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                if (strlen($refList) > 0)
                    $refList .= ',$' . $attr . ' = null';
                else
                    $refList .= '$' . $attr . ' = null';
            }
        }
        $code = 'public function applyValuesBeforeSaveObject('.$refList.')  {
        if (!$this->Object)
            $this->Object = new '.$objectName.'();
        ';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $isDate = false;
            $objectAttrValue = $this->getAttributeGetValueString($objectName,$attr).';';
            if (($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATE') || ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME')) {
                $objectAttrValue = 'new QDateTime($this->txt'.$attr.'->Text);';
                $isDate = true;
            }
            if ($isDate) {
                if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                    $code .= '
        if (strlen($this->txt'.$attr.'->Text) > 0) {
            if ($this->lst'.$attr.'Hours->SelectedIndex > 0)
                $this->Object->'.$attr.' = new QDateTime($this->txt'.$attr.'->Text.\' \'.$this->lst'.$attr.'Hours->SelectedValue.\':\'.$this->lst'.$attr.'Minutes->SelectedValue);
            else
                $this->Object->'.$attr.' = new QDateTime($this->txt'.$attr.'->Text);
        }';
                } else {
                    $code .= '
        if (strlen($this->txt'.$attr.'->Text) > 0) {
            $this->Object->'.$attr.' = '.$objectAttrValue.'
        }';
                }
            } else {
                $code .= '
        $this->Object->'.$attr.' = '.$objectAttrValue;
            }

        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        if ($'.$attr.') {
            $this->Object->'.$attr.'Object = $'.$attr.';
        }';
                $code .= '
        if ($this->saveUsingLst'.$attr.') {
            $linked'.$attr.' = '.$attr.'::Load($this->lst'.$attr.'->SelectedValue);
            $this->Object->'.$attr.'Object = $linked'.$attr.';
        }';
            }
        }
        $code .= '
    }';
        return $code;
    }
    protected function createControllerFunction_deleteObject() {
        $code = 'public function deleteObject()  {
        if (!$this->deleteWithAudit()) {
            AppSpecificFunctions::DisplayAlert(\'Could not delete the object right now. Please try again later...\');
            return false;
        }
        return true;
    }';
        return $code;
    }
    protected function createControllerFunction_validateObject($objectName) {
        $code = 'public function validateObject()  {
        $hasNoErrors = true;
        //$this->resetValidation();';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= $this->getAttributeValidationString($objectName,$attr);
        }
        $code .= '
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);\';';
        $code .= '
        return $hasNoErrors;
    }';
        return $code;
    }
    protected function createControllerFunction_resetValidation($objectName) {
        $code = 'public function resetValidation()  {';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= $this->getAttributeResetValidationString($objectName,$attr);
        }
        $code .= '
        $js = AppSpecificFunctions::GetDatePickerInitJs();
        AppSpecificFunctions::ExecuteJavaScript($js);
    }';
        return $code;
    }
    protected function createControllerFunction_saveWithAudit($objectName) {
        $code = 'public function saveWithAudit() {
        try {
            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            error_log(\'Could not save object. Error: \'.$e->getMessage());
            return false;
        }
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object)
            $previousValues = '.$objectName.'::Load($this->Object->Id);
        $changeText = \'\';
        if ($previousValues) {
        $changeText = \'';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= $attr.'-> Value before: \'.$previousValues->'.$attr.'.\', Value after: \'.$this->Object->'.$attr.'.\'<br>
        ';
        }
        // TO DO: Fix this to check for empty references before saving
        /*if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= $attr.'Object-> Value before: \'.$previousValues->'.$attr.'Object->Id.\', Value after: \'.$this->Object->'.$attr.'Object->Id.\'<br>
        ';
            }
        }*/
        $code .= '\';
        } else {
        $changeText = \'';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= $attr.'-> Value: \'.$this->Object->'.$attr.'.\'<br>
        ';
        }
        // TO DO: Fix this to check for empty references before saving
        /*if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= $attr.'Object-> Value: \'.$this->Object->'.$attr.'Object->Id.\'<br>
        ';
            }
        }*/
        $code .='\';
        }
        try {
            $AuditLogEntry = new AuditLogEntry();
            $AuditLogEntry->EntryTimeStamp = QDateTime::Now(true);
            $AuditLogEntry->ModificationType = \'Create\';
            if ($previousValues) {
                $AuditLogEntry->ObjectId = $this->Object->Id;
                $AuditLogEntry->ModificationType = \'Update\';
            }
            $AuditLogEntry->ObjectName = \''.$objectName.'\';
            $AuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $AuditLogEntry->AuditLogEntryDetail = $changeText;
            $AuditLogEntry->Save();

            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            AppSpecificFunctions::DisplayAlert(\'Could not save right now. Please try again later...\');
            return false;
        }*/
    }';
        return $code;

    }
    protected function createControllerFunction_deleteWithAudit($objectName) {
        $code = 'public function deleteWithAudit() {
        $this->Object->Delete();
        return true;
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object){
            try {
                $AuditLogEntry = new AuditLogEntry();
                $AuditLogEntry->EntryTimeStamp = QDateTime::Now(true);
                $AuditLogEntry->ModificationType = \'Delete\';
                $AuditLogEntry->ObjectName = \''.$objectName.'\';
                $AuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
                $AuditLogEntry->AuditLogEntryDetail = \'\';
                $AuditLogEntry->ObjectId = $this->Object->Id;
                $AuditLogEntry->Save();
                $this->Object->Delete();
                return true;
            } catch (QCallerException $e) {
                return false;
            }
        } else
            return false;
        */
    }';
        return $code;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Generate the Front End files
    protected function createFrontEndContentFile($objectName) {
        if (!file_exists('Generated/'.$objectName)) {
            mkdir('Generated/'.$objectName, 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/'.$objectName."FrontEnd.php", "w") or die("Unable to open file!");
        $code = '<?php
?>

';
        $code .= $this->createFrontEndRow($objectName);
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/'.$objectName."FrontEnd.php", 0755);

        if (!file_exists('Implementations/'.$objectName.'/'.$objectName."FrontEnd.php")) {
            $generatedFile = fopen('Implementations/'.$objectName.'/'.$objectName."FrontEnd.php", "w") or die("Unable to open file!");
            $code = '<?php
?>

';
            $code .= $this->createFrontEndRow($objectName);
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod('Implementations/'.$objectName.'/'.$objectName."FrontEnd.php", 0755);
        }
    }
    protected function createFrontEndRow($objectName) {
        $code = '<div class="row">';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
    <div class="col-md-6">
        <?php $this->'.$objectName.'Instance->renderControl(\''.$attr.'\');?>
    </div>';
            if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
                $code .= '
    <div class="col-md-6">
        <?php $this->'.$objectName.'Instance->renderControl(\''.$attr.'Time\',true,\'Time\');?>
    </div>';
            }
        }
        $code .='
</div>';
        return $code;
    }
    protected function createFrontEndModalFile($objectName) {
        if (!file_exists('Generated/'.$objectName)) {
            mkdir('Generated/'.$objectName, 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/'.$objectName."Modal.php", "w") or die("Unable to open file!");
        $code = '<?php
?>
';
        $code .= '<div id="'.$objectName.'Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="'.$objectName.'ModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="'.$objectName.'ModalLabel">'.$objectName.' Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.\'/Generated/'.$objectName.'/'.$objectName.'FrontEnd.php\');?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">
                        <?php $this->btnSave'.$objectName.'->Render();?>
                    </div>
                    <div class="col-md-4">
                        <?php $this->btnDelete'.$objectName.'->Render();?>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/'.$objectName."Modal.php", 0755);

        if (!file_exists('Implementations/'.$objectName.'/'.$objectName."Modal.php")) {
            $generatedFile = fopen('Implementations/'.$objectName.'/'.$objectName."Modal.php", "w") or die("Unable to open file!");
            $code = '<?php
?>
';
            $code .= '<div id="'.$objectName.'Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="'.$objectName.'ModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="'.$objectName.'ModalLabel">'.$objectName.' Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'FrontEnd.php\');?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">
                        <?php $this->btnSave'.$objectName.'->Render();?>
                    </div>
                    <div class="col-md-4">
                        <?php $this->btnDelete'.$objectName.'->Render();?>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod('Implementations/'.$objectName.'/'.$objectName."Modal.php", 0755);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Generate the Page Drafts
    protected function createPageBackEndDraftOverviewFile($objectName) {
        if (!file_exists('Generated/'.$objectName.'/PageDrafts')) {
            mkdir('Generated/'.$objectName.'/PageDrafts', 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Overview.php", "w") or die("Unable to open file!");
        $code = $this->getPageDraft_Overview_Setup($objectName);
        $code .= $this->getPageDraft_Overview_Class_Start($objectName);
        $code .= $this->getPageDraft_Overview_Variable_Declarations($objectName);
        $code .= $this->getPageDraft_Overview_Form_Create_Function($objectName);
        $code .= $this->getPageDraft_Overview_InitObjectModal_Function($objectName);
        $code .= $this->getPageDraft_Overview_btnSaveObject_Clicked_Function($objectName);
        $code .= $this->getPageDraft_Overview_btnDeleteObject_Clicked_Function($objectName);
        $code .= $this->getPageDraft_Overview_InitObjectDataGrid($objectName);
        $code .= $this->getPageDraft_Overview_DataGrid_Click_Functions($objectName);
        $code .= $this->getPageDraft_Overview_Additional_Controller_Functions($objectName);
        $code .= $this->getPageDraft_Overview_Class_End($objectName);
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Overview.php", 0755);

        $generatedFile = fopen('Generated/'.$objectName.'/PageDrafts/'.$objectName."_List.php", "w") or die("Unable to open file!");
        $code = $this->getPageDraft_List_Setup($objectName);
        $code .= $this->getPageDraft_List_Class_Start($objectName);
        $code .= $this->getPageDraft_List_Variable_Declarations($objectName);
        $code .= $this->getPageDraft_List_Form_Create_Function($objectName);
        $code .= $this->getPageDraft_List_InitObjectModal_Function($objectName);
        $code .= $this->getPageDraft_List_btnSaveObject_Clicked_Function($objectName);
        $code .= $this->getPageDraft_List_btnDeleteObject_Clicked_Function($objectName);
        $code .= $this->getPageDraft_List_InitObjectDataList($objectName);
        $code .= $this->getPageDraft_List_DataList_Click_Functions($objectName);
        $code .= $this->getPageDraft_List_Additional_Controller_Functions($objectName);
        $code .= $this->getPageDraft_List_Class_End($objectName);
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/PageDrafts/'.$objectName."_List.php", 0755);

        // Generate the DataGrid Implementation needed for this overview
        if (!file_exists('../sDevControls/Implementations/'.$objectName)) {
            mkdir('../sDevControls/Implementations/'.$objectName, 0755, true);
        }
        if (!file_exists('../sDevControls/Implementations/'.$objectName.'/'.$objectName."DataGrid.php")) {
            $generatedFile = fopen('../sDevControls/Implementations/'.$objectName.'/'.$objectName."DataGrid.php", "w") or die("Unable to open file!");
            $code = '<?php
class '.$objectName.'DataGrid extends sDataGrid{


    public function __construct($objParentObject,
                                $theDataGridEntityNode, $searchableAttributes, $searchBoxText, $headerItems, $headerSortNodes, $columnItems, $queryConditions = null,
                                $initialItemsPerPage = 5, $objWaitIcon = null, $ajaxHandle = \'default\',$sessionIdentifier = \'datagridSessionId\',
                                $rememberState = false,$exportHeaderItems = null,$exportColumnItems = null) {

        parent::__construct($objParentObject, $theDataGridEntityNode, $searchableAttributes, $searchBoxText,
            $headerItems, $headerSortNodes, $columnItems, $queryConditions, $initialItemsPerPage, $objWaitIcon, $ajaxHandle,
            $sessionIdentifier, $rememberState, $exportHeaderItems, $exportColumnItems);

    }
}
?>';
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod('../sDevControls/Implementations/'.$objectName.'/'.$objectName."DataGrid.php", 0755);
        }

        if (!file_exists('../sDevControls/Implementations/'.$objectName.'/'.$objectName."DataList.php")) {
            $generatedFile = fopen('../sDevControls/Implementations/'.$objectName.'/'.$objectName."DataList.php", "w") or die("Unable to open file!");
            $code = '<?php
class '.$objectName.'DataList extends sDataList{
    public function __construct(QForm $objParentObject, $EntityNode, $SearchableAttributes = null, $SearchBoxText = null, $ColumnItems = null, $SortAttributes = null,
                                $SortAttributesShown = null, $DefaultSortAttribute = null, $DefaultSortDirectionDown = false, $ColumnWeights = null,
                                $QueryConditions = null, $InitialItemCount = 10, $ItemIncrement = 5, $ajaxHandle = null, $ShowSearch = true, $ShowSort = true,
                                $sessionIdentifier = \'DataListSessionId\', $rememberState = false) {

        parent::__construct($objParentObject, $EntityNode, $SearchableAttributes, $SearchBoxText, $ColumnItems, $SortAttributes,
                                $SortAttributesShown, $DefaultSortAttribute, $DefaultSortDirectionDown, $ColumnWeights,
                                $QueryConditions, $InitialItemCount, $ItemIncrement, $ajaxHandle, $ShowSearch, $ShowSort,
                                $sessionIdentifier, $rememberState);

    }
}
?>';
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod('../sDevControls/Implementations/'.$objectName.'/'.$objectName."DataList.php", 0755);
        }
    }
    protected function createPageFrontEndDraftOverviewFile($objectName) {
        if (!file_exists('Generated/'.$objectName.'/PageDrafts')) {
            mkdir('Generated/'.$objectName.'/PageDrafts', 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Overview.tpl.php", "w") or die("Unable to open file!");
        $code = '<?php $strPageTitle = \''.$objectName.' Overview\';?>
<?php require(__CONFIGURATION__ . \'/header_with_nav.inc.php\');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'Modal.php\');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">'.$objectName.' Overview</h3>
        <?php $this->'.$objectName.'Grid->RenderGrid();?>
        <?php $this->btnNew'.$objectName.'->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . \'/footer.inc.php\');	?>';
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Overview.tpl.php", 0755);

        $generatedFile = fopen('Generated/'.$objectName.'/PageDrafts/'.$objectName."_List.tpl.php", "w") or die("Unable to open file!");
        $code = '<?php $strPageTitle = \''.$objectName.' List\';?>
<?php require(__CONFIGURATION__ . \'/header_with_nav.inc.php\');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'Modal.php\');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">'.$objectName.' List</h3>
        <?php $this->'.$objectName.'List->RenderList();?>
        <?php $this->btnNew'.$objectName.'->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . \'/footer.inc.php\');	?>';
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/PageDrafts/'.$objectName."_List.tpl.php", 0755);
    }
    protected function createPageBackEndDraftDetailFile($objectName) {
        if (!file_exists('Generated/'.$objectName.'/PageDrafts')) {
            mkdir('Generated/'.$objectName.'/PageDrafts', 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Detail.php", "w") or die("Unable to open file!");
        $code = $this->getPageDraft_Detail_Setup($objectName);
        $code .= $this->getPageDraft_Detail_Class_Start($objectName);
        $code .= $this->getPageDraft_Detail_Variable_Declarations($objectName);
        $code .= $this->getPageDraft_Detail_Form_Create_Function($objectName);
        $code .= $this->getPageDraft_Detail_InitObjectInstance_Function($objectName);
        $code .= $this->getPageDraft_Detail_btnSaveObject_Clicked_Function($objectName);
        $code .= $this->getPageDraft_Detail_btnDeleteObject_Clicked_Function($objectName);
        $code .= $this->getPageDraft_Detail_btnCancelObject_Clicked_Function($objectName);
        $code .= $this->getPageDraft_Detail_Additional_Controller_Functions($objectName);
        $code .= $this->getPageDraft_Detail_Class_End($objectName);
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Detail.php", 0755);
    }
    protected function createPageFrontEndDraftDetailFile($objectName) {
        if (!file_exists('Generated/'.$objectName.'/PageDrafts')) {
            mkdir('Generated/'.$objectName.'/PageDrafts', 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Detail.tpl.php", "w") or die("Unable to open file!");
        $code = '<?php $strPageTitle = \''.$objectName.' Detail\';?>
<?php require(__CONFIGURATION__ . \'/header_with_nav.inc.php\');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">'.$objectName.' Detail</h3>
        <?php require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'FrontEnd.php\');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSave'.$objectName.'->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDelete'.$objectName.'->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancel'.$objectName.'->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . \'/footer.inc.php\');	?>';
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/PageDrafts/'.$objectName."_Detail.tpl.php", 0755);
    }

    // Generate the Form Template Drafts
    protected function createPageBackEndFormTemplateDraftFile($objectName) {
        if (!file_exists('Generated/'.$objectName.'/FormTemplates')) {
            mkdir('Generated/'.$objectName.'/FormTemplates', 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/FormTemplates/'.$objectName."_Template.php", "w") or die("Unable to open file!");
        $code = $this->getPageFormTemplate_Setup($objectName);
        $code .= $this->getPageDraft_Detail_Class_Start($objectName);
        $code .= $this->getPageDraft_Detail_Variable_Declarations($objectName);
        $code .= $this->getPageDraft_Detail_Form_Create_Function($objectName);
        $code .= $this->getPageDraft_Detail_InitObjectInstance_Function($objectName);
        $code .= $this->getPageFormTemplate_btnSaveObject_Clicked_Function($objectName);
        $code .= $this->getPageFormTemplate_btnDeleteObject_Clicked_Function($objectName);
        $code .= $this->getPageFormTemplate_executeParentFunction_Function($objectName);
        $code .= $this->getPageDraft_Detail_Additional_Controller_Functions($objectName);
        $code .= $this->getPageDraft_Detail_Class_End($objectName);
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/FormTemplates/'.$objectName."_Template.php", 0755);
    }
    protected function createPageFrontEndFormTemplateDraftFile($objectName) {
        if (!file_exists('Generated/'.$objectName.'/FormTemplates')) {
            mkdir('Generated/'.$objectName.'/FormTemplates', 0755, true);
        }
        $generatedFile = fopen('Generated/'.$objectName.'/FormTemplates/'.$objectName."_Template.tpl.php", "w") or die("Unable to open file!");
        $code = '<?php $strPageTitle = \''.$objectName.' Template\';?>
<?php require(__CONFIGURATION__ . \'/header_form_templates.inc.php\');	?>
<style>
    body {
        padding: 0px;
        margin:0px;
    }
</style>
<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'FrontEnd.php\');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSave'.$objectName.'->Render();?>
        <!--<?php $this->btnDelete'.$objectName.'->Render();?>
        <?php $this->btnCancel'.$objectName.'->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . \'/footer.inc.php\');	?>';
        fwrite($generatedFile, $code);
        fclose($generatedFile);
        chmod('Generated/'.$objectName.'/FormTemplates/'.$objectName."_Template.tpl.php", 0755);
    }

    // Generate the Form Templates
    protected function createPageBackEndFormTemplateFile($objectName) {
        if (!file_exists('Implementations/'.$objectName.'/FormTemplates')) {
            mkdir('Implementations/'.$objectName.'/FormTemplates', 0755, true);
        }
        if (!file_exists('Implementations/'.$objectName.'/FormTemplates/'.$objectName."_Template.php")) {
            $generatedFile = fopen('Implementations/'.$objectName.'/FormTemplates/'.$objectName."_Template.php", "w") or die("Unable to open file!");
            $code = $this->getPageFormTemplate_Setup($objectName);
            $code .= $this->getPageDraft_Detail_Class_Start($objectName);
            $code .= $this->getPageDraft_Detail_Variable_Declarations($objectName);
            $code .= $this->getPageDraft_Detail_Form_Create_Function($objectName);
            $code .= $this->getPageDraft_Detail_InitObjectInstance_Function($objectName);
            $code .= $this->getPageFormTemplate_btnSaveObject_Clicked_Function($objectName);
            $code .= $this->getPageFormTemplate_btnDeleteObject_Clicked_Function($objectName);
            $code .= $this->getPageFormTemplate_executeParentFunction_Function($objectName);
            $code .= $this->getPageDraft_Detail_Additional_Controller_Functions($objectName);
            $code .= $this->getPageDraft_Detail_Class_End($objectName);
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod('Implementations/'.$objectName.'/FormTemplates/'.$objectName."_Template.php", 0755);
        }
    }
    protected function createPageFrontEndFormTemplateFile($objectName) {
        if (!file_exists('Implementations/'.$objectName.'/FormTemplates')) {
            mkdir('Implementations/'.$objectName.'/FormTemplates', 0755, true);
        }
        if (!file_exists('Implementations/'.$objectName.'/FormTemplates/'.$objectName."_Template.tpl.php")) {
            $generatedFile = fopen('Implementations/'.$objectName.'/FormTemplates/'.$objectName."_Template.tpl.php", "w") or die("Unable to open file!");
            $code = '<?php $strPageTitle = \''.$objectName.' Template\';?>
<?php require(__CONFIGURATION__ . \'/header_form_templates.inc.php\');	?>
<style>
    body {
        padding: 0px;
        margin:0px;
    }
</style>
<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'FrontEnd.php\');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSave'.$objectName.'->Render();?>
        <!--<?php $this->btnDelete'.$objectName.'->Render();?>
        <?php $this->btnCancel'.$objectName.'->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . \'/footer.inc.php\');	?>';
            fwrite($generatedFile, $code);
            fclose($generatedFile);
            chmod('Implementations/'.$objectName.'/FormTemplates/'.$objectName."_Template.tpl.php", 0755);
        }
    }

    // Functions for createPageBackEndDraftOverviewFile
    protected function getPageDraft_Overview_Setup($objectName) {
        $code = '<?php
require(\'../../sdev.inc.php\');
require(__PAGE_CONTROL__.\'/pageManager.php\');
require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'Controller.php\');
require(__SDEV_CONTROLS__.\'/Implementations/'.$objectName.'/'.$objectName.'DataGrid.php\');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array(\'Administrator\'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.\'/login/\');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();';
        return $code;
    }
    protected function getPageDraft_Overview_Class_Start($objectName) {
        $code = '
class '.$objectName.'_OverviewForm extends QForm {';
        return $code;
    }
    protected function getPageDraft_Overview_Variable_Declarations($objectName) {
        $code = '
    // Data grid variables
    protected $'.$objectName.'Grid;
    protected $'.$objectName.'WaitControlIcon;
    protected $btnNew'.$objectName.';
    protected $selected'.$objectName.'Id = -1;

    // '.$objectName.' Object variables
    protected $'.$objectName.'Instance;
    protected $btnSave'.$objectName.',$btnDelete'.$objectName.';

    //Mobile css
    protected $buttonFullWidthCss = \'\';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////';
        return $code;
    }
    protected function getPageDraft_Overview_Form_Create_Function($objectName) {
        $code = '
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == \'phone\')
            $this->buttonFullWidthCss = \'fullWidth mrg-bottom5\';

        $this->Init'.$objectName.'DataGrid();
        $this->Init'.$objectName.'Modal();
    }';
        return $code;
    }
    protected function getPageDraft_Overview_InitObjectModal_Function($objectName) {
        $code = '
    protected function Init'.$objectName.'Modal() {
        $this->'.$objectName.'Instance = new '.$objectName.'Controller($this);

        $this->btnSave'.$objectName.' = new QButton($this);
        $this->btnSave'.$objectName.'->Text = \'Save\';
        $this->btnSave'.$objectName.'->CssClass = \'btn btn-success rippleclick mrg-top10 fullWidth\';
        $this->btnSave'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnSave'.$objectName.'_Clicked\'));

        $this->btnDelete'.$objectName.' = new QButton($this);
        $this->btnDelete'.$objectName.'->Text = \'Delete\';
        $this->btnDelete'.$objectName.'->CssClass = \'btn btn-danger rippleclick mrg-top10 fullWidth\';
        $this->btnDelete'.$objectName.'->AddAction(new QClickEvent(), new QConfirmAction(\'Are you sure?\'));
        $this->btnDelete'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnDelete'.$objectName.'_Clicked\'));
    }';
        return $code;
    }
    protected function getPageDraft_Overview_btnSaveObject_Clicked_Function($objectName) {
        $code = '
    protected function btnSave'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->saveObject()) {
            $this->'.$objectName.'Grid->UpdateGrid();
            AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
        }
    }';
        return $code;
    }
    protected function getPageDraft_Overview_btnDeleteObject_Clicked_Function($objectName) {
        $code = '
    protected function btnDelete'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->deleteObject()) {
            $this->'.$objectName.'Grid->UpdateGrid();
            AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
        }
    }';
        return $code;
    }
    protected function getPageDraft_Overview_InitObjectDataGrid($objectName) {
        $searchableAttrsText = '$searchableAttributes = array(';
        $headerItemsText = '$headerItems = array(';
        $headerSortNodesText = '$headerSortNodes = array(';
        $columnItemsText = '$columnItems = array(';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $searchableAttrsText .= 'QQN::'.$objectName.'()->'.$attr.',';
            $headerItemsText .= '\''.$this->getCamelCaseSplitted($attr).'\',';
            $headerSortNodesText .= 'QQN::'.$objectName.'()->'.$attr.',';
            $columnItemsText .= '\''.$attr.'\',';
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $searchableAttrsText .= 'QQN::'.$objectName.'()->'.$attr.'Object->Id,';
                $headerItemsText .= '\''.$this->getCamelCaseSplitted($attr).' Object\',';
                $headerSortNodesText .= 'QQN::'.$objectName.'()->'.$attr.'Object->Id,';
                $columnItemsText .= '\''.$attr.'\',';
            }
        }
        $searchableAttrsText = substr($searchableAttrsText,0,strlen($searchableAttrsText)-1);
        $searchableAttrsText .= ');';
        $headerItemsText = substr($headerItemsText,0,strlen($headerItemsText)-1);
        $headerItemsText .= ');';
        $headerSortNodesText = substr($headerSortNodesText,0,strlen($headerSortNodesText)-1);
        $headerSortNodesText .= ');';
        $columnItemsText = substr($columnItemsText,0,strlen($columnItemsText)-1);
        $columnItemsText .= ');';
        $code = '
    protected function Init'.$objectName.'DataGrid() {
        '.$searchableAttrsText.'
        '.$headerItemsText.'
        '.$headerSortNodesText.'
        '.$columnItemsText.'
        $this->'.$objectName.'WaitControlIcon = new QWaitIcon($this);
        $this->btnNew'.$objectName.' = new QButton($this);
        $this->btnNew'.$objectName.'->Text = \'Add '.$objectName.'\';
        $this->btnNew'.$objectName.'->CssClass = \'btn btn-primary rippleclick mrg-top10 \'.$this->buttonFullWidthCss;
        $this->btnNew'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnNew'.$objectName.'_Clicked\'));
        $this->'.$objectName.'Grid = new '.$objectName.'DataGrid($this, QQN::'.$objectName.'(),$searchableAttributes, \'Search...\', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->'.$objectName.'WaitControlIcon, \''.$objectName.'Grid\');
    }';
        return $code;
    }
    protected function getPageDraft_Overview_DataGrid_Click_Functions($objectName) {
        $code = '
    protected function '.$objectName.'Grid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'Grid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'Grid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'Grid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'Grid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'Grid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'Grid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'Grid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'Grid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'Grid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'Grid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selected'.$objectName.'Id = $strParameter;
        $theObject = '.$objectName.'::Load($this->selected'.$objectName.'Id);
        if ($theObject) {
            $this->'.$objectName.'Instance->setObject($theObject);
            $this->'.$objectName.'Instance->setValues($theObject);
            $this->'.$objectName.'Instance->refreshAll();
            $this->btnDelete'.$objectName.'->Visible = true;
            AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
        }
    }
    protected function btnNew'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selected'.$objectName.'Id = -1;
        $this->'.$objectName.'Instance->setObject(null);
        $this->'.$objectName.'Instance->setValues(null);
        $this->btnDelete'.$objectName.'->Visible = false;
        AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
    }';
        return $code;
    }
    protected function getPageDraft_Overview_Additional_Controller_Functions($objectName) {
        $code = '';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            //TODO: Support more renders here...
            $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
            if ($attrSpecialRender) {
                if (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                    $code = '
    protected function btn'.$attr.'_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->'.$objectName.'Instance->getControlId(\''.$attr.'\'))->Toggle(!$this->GetControl($this->'.$objectName.'Instance->getControlId(\''.$attr.'\'))->IsToggled);
    }

    ';
                }
            }
        }

        return $code;
    }
    protected function getPageDraft_Overview_Class_End($objectName) {
        $code = '
}
'.$objectName.'_OverviewForm::Run(\''.$objectName.'_OverviewForm\');
?>';
        return $code;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Functions for createPageBackEndDraftListFile
    protected function getPageDraft_List_Setup($objectName) {
        $code = '<?php
require(\'../../sdev.inc.php\');
require(__PAGE_CONTROL__.\'/pageManager.php\');
require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'Controller.php\');
require(__SDEV_CONTROLS__.\'/Implementations/'.$objectName.'/'.$objectName.'DataList.php\');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array(\'Administrator\'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.\'/login/\');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();';
        return $code;
    }
    protected function getPageDraft_List_Class_Start($objectName) {
        $code = '
class '.$objectName.'_ListForm extends QForm {';
        return $code;
    }
    protected function getPageDraft_List_Variable_Declarations($objectName) {
        $code = '
    // Data list variables
    protected $'.$objectName.'List;
    protected $btnNew'.$objectName.';

    // '.$objectName.' Object variables
    protected $'.$objectName.'Instance;
    protected $btnSave'.$objectName.',$btnDelete'.$objectName.';

    //Mobile css
    protected $buttonFullWidthCss = \'\';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////';
        return $code;
    }
    protected function getPageDraft_List_Form_Create_Function($objectName) {
        $code = '
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == \'phone\')
            $this->buttonFullWidthCss = \'fullWidth mrg-bottom5\';

        $this->Init'.$objectName.'DataList();
        $this->Init'.$objectName.'Modal();
    }';
        return $code;
    }
    protected function getPageDraft_List_InitObjectModal_Function($objectName) {
        $code = '
    protected function Init'.$objectName.'Modal() {
        $this->'.$objectName.'Instance = new '.$objectName.'Controller($this);

        $this->btnSave'.$objectName.' = new QButton($this);
        $this->btnSave'.$objectName.'->Text = \'Save\';
        $this->btnSave'.$objectName.'->CssClass = \'btn btn-success rippleclick mrg-top10 fullWidth\';
        $this->btnSave'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnSave'.$objectName.'_Clicked\'));

        $this->btnDelete'.$objectName.' = new QButton($this);
        $this->btnDelete'.$objectName.'->Text = \'Delete\';
        $this->btnDelete'.$objectName.'->CssClass = \'btn btn-danger rippleclick mrg-top10 fullWidth\';
        $this->btnDelete'.$objectName.'->AddAction(new QClickEvent(), new QConfirmAction(\'Are you sure?\'));
        $this->btnDelete'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnDelete'.$objectName.'_Clicked\'));
    }';
        return $code;
    }
    protected function getPageDraft_List_btnSaveObject_Clicked_Function($objectName) {
        $code = '
    protected function btnSave'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->saveObject()) {
            $this->'.$objectName.'List->refreshList();
            AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
        }
    }';
        return $code;
    }
    protected function getPageDraft_List_btnDeleteObject_Clicked_Function($objectName) {
        $code = '
    protected function btnDelete'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->deleteObject()) {
            $this->'.$objectName.'List->refreshList();
            AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
        }
    }';
        return $code;
    }
    protected function getPageDraft_List_InitObjectDataList($objectName) {
        $searchableAttrsText = '$searchableAttributes = array(';
        $SortAttributesShownText = '$SortAttributesShown = array(';
        $SortAttributesText = '$SortAttributes = array(';
        $columnItemsText = '$columnItems = array(';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $searchableAttrsText .= 'QQN::'.$objectName.'()->'.$attr.',';
            $SortAttributesShownText .= '\''.$this->getCamelCaseSplitted($attr).'\',';
            $SortAttributesText .= 'QQN::'.$objectName.'()->'.$attr.',';
            $columnItemsText .= '\''.$attr.'\',';
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $searchableAttrsText .= 'QQN::'.$objectName.'()->'.$attr.'Object->Id,';
                $SortAttributesShownText .= '\''.$this->getCamelCaseSplitted($attr).' Object\',';
                $SortAttributesText .= 'QQN::'.$objectName.'()->'.$attr.'Object->Id,';
                $columnItemsText .= '\''.$attr.'\',';
            }
        }
        $searchableAttrsText = substr($searchableAttrsText,0,strlen($searchableAttrsText)-1);
        $searchableAttrsText .= ');';
        $SortAttributesShownText = substr($SortAttributesShownText,0,strlen($SortAttributesShownText)-1);
        $SortAttributesShownText .= ');';
        $SortAttributesText = substr($SortAttributesText,0,strlen($SortAttributesText)-1);
        $SortAttributesText .= ');';
        $columnItemsText = substr($columnItemsText,0,strlen($columnItemsText)-1);
        $columnItemsText .= ');';
        $code = '
    protected function Init'.$objectName.'DataList() {
        '.$searchableAttrsText.'
        '.$SortAttributesShownText.'
        '.$SortAttributesText.'
        '.$columnItemsText.'
        $this->btnNew'.$objectName.' = AppSpecificFunctions::getNewActionButton($this,\'Add '.$objectName.'\',\'btn btn-primary rippleclick mrg-top10 \'.$this->buttonFullWidthCss,\'btnNew'.$objectName.'_Clicked\');
        $this->'.$objectName.'List = new '.$objectName.'DataList($this, QQN::'.$objectName.'(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }';
        return $code;
    }
    protected function getPageDraft_List_DataList_Click_Functions($objectName) {
        $code = '
    protected function '.$objectName.'_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'List->getActiveId() != $strParameter)
                $this->'.$objectName.'List->setActiveId($strParameter);
            else
                $this->'.$objectName.'List->setActiveId(null);
        $theObject = '.$objectName.'::Load($strParameter);
        if ($theObject) {
            $this->'.$objectName.'Instance->setObject($theObject);
            $this->'.$objectName.'Instance->setValues($theObject);
            $this->'.$objectName.'Instance->refreshAll();
            $this->btnDelete'.$objectName.'->Visible = true;
            AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
        }
    }
    protected function '.$objectName.'_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'List->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'List->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'List->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'List->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function '.$objectName.'_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'List->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNew'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        $this->'.$objectName.'List->setActiveId(null);
        $this->'.$objectName.'Instance->setObject(null);
        $this->'.$objectName.'Instance->setValues(null);
        $this->btnDelete'.$objectName.'->Visible = false;
        AppSpecificFunctions::ToggleModal(\''.$objectName.'Modal\');
    }';
        return $code;
    }
    protected function getPageDraft_List_Additional_Controller_Functions($objectName) {
        $code = '';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            //TODO: Support more renders here...
            $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
            if ($attrSpecialRender) {
                if (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                    $code = '
    protected function btn'.$attr.'_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->'.$objectName.'Instance->getControlId(\''.$attr.'\'))->Toggle(!$this->GetControl($this->'.$objectName.'Instance->getControlId(\''.$attr.'\'))->IsToggled);
    }

    ';
                }
            }
        }

        return $code;
    }
    protected function getPageDraft_List_Class_End($objectName) {
        $code = '
}
'.$objectName.'_ListForm::Run(\''.$objectName.'_ListForm\');
?>';
        return $code;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Functions for createPageBackEndDraftDetailFile
    protected function getPageDraft_Detail_Setup($objectName) {
        $code = '<?php
require(\'../../sdev.inc.php\');
require(__PAGE_CONTROL__.\'/pageManager.php\');
require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'Controller.php\');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array(\'Administrator\'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.\'/login/\');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();';
        return $code;
    }
    protected function getPageFormTemplate_Setup($objectName) {
        $code = '<?php
require(\'../../../../sdev.inc.php\');
require(__SDEV_ORM__.\'/Implementations/'.$objectName.'/'.$objectName.'Controller.php\');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array(\'Administrator\'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.\'/login/\');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();';
        return $code;
    }
    protected function getPageDraft_Detail_Class_Start($objectName) {
        $code = '
class '.$objectName.'_DetailForm extends QForm {';
        return $code;
    }
    protected function getPageDraft_Detail_Variable_Declarations($objectName) {
        $code = '
    // '.$objectName.' Object variables
    protected $'.$objectName.'Instance;
    protected $btnSave'.$objectName.',$btnDelete'.$objectName.',$btnCancel'.$objectName.';

    //Mobile detection
    protected $buttonFullWidthCss = \'\';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////';
        return $code;
    }
    protected function getPageDraft_Detail_Form_Create_Function($objectName) {
        $code = '
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == \'phone\')
            $this->buttonFullWidthCss = \'fullWidth mrg-bottom5\';

        $this->Init'.$objectName.'Instance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = '.$objectName.'::Load($objId);
            if ($theObject) {
                $this->'.$objectName.'Instance->setObject($theObject);
                $this->'.$objectName.'Instance->setValues($theObject);
                $this->'.$objectName.'Instance->refreshAll();
                $this->btnDelete'.$objectName.'->Visible = true;
            } else {
                $this->'.$objectName.'Instance->setObject(null);
                $this->'.$objectName.'Instance->setValues(null);
                $this->btnDelete'.$objectName.'->Visible = false;
            }
        } else {
            $this->'.$objectName.'Instance->setObject(null);
            $this->'.$objectName.'Instance->setValues(null);
            $this->btnDelete'.$objectName.'->Visible = false;
        }
    }';
        return $code;
    }
    protected function getPageDraft_Detail_InitObjectInstance_Function($objectName) {
        $code = '
    protected function Init'.$objectName.'Instance() {
        $this->'.$objectName.'Instance = new '.$objectName.'Controller($this);

        $this->btnSave'.$objectName.' = new QButton($this);
        $this->btnSave'.$objectName.'->Text = \'Save\';
        $this->btnSave'.$objectName.'->CssClass = \'btn btn-primary mrg-top10 rippleclick\';
        $this->btnSave'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnSave'.$objectName.'_Clicked\'));

        $this->btnDelete'.$objectName.' = new QButton($this);
        $this->btnDelete'.$objectName.'->Text = \'Delete\';
        $this->btnDelete'.$objectName.'->CssClass = \'btn btn-danger mrg-top10 rippleclick\';
        $this->btnDelete'.$objectName.'->AddAction(new QClickEvent(), new QConfirmAction(\'Are you sure?\'));
        $this->btnDelete'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnDelete'.$objectName.'_Clicked\'));

        $this->btnCancel'.$objectName.' = new QButton($this);
        $this->btnCancel'.$objectName.'->Text = \'Cancel\';
        $this->btnCancel'.$objectName.'->CssClass = \'btn btn-default mrg-top10 rippleclick\';
        $this->btnCancel'.$objectName.'->AddAction(new QClickEvent(), new QAjaxAction(\'btnCancel'.$objectName.'_Clicked\'));
    }';
        return $code;
    }
    protected function getPageDraft_Detail_btnSaveObject_Clicked_Function($objectName) {
        $code = '
    protected function btnSave'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }';
        return $code;
    }
    protected function getPageDraft_Detail_btnDeleteObject_Clicked_Function($objectName) {
        $code = '
    protected function btnDelete'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }';
        return $code;
    }
    protected function getPageDraft_Detail_btnCancelObject_Clicked_Function($objectName) {
        $code = '
    protected function btnCancel'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }';
        return $code;
    }
    protected function getPageFormTemplate_btnSaveObject_Clicked_Function($objectName) {
        $code = '
    protected function btnSave'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback(\'Saved!\');
        } else
            AppSpecificFunctions::ShowNotedFeedback(\'Could not save right now! Pleae try again.\',false);
    }';
        return $code;
    }
    protected function getPageFormTemplate_btnDeleteObject_Clicked_Function($objectName) {
        $code = '
    protected function btnDelete'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->'.$objectName.'Instance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback(\'Deleted!\');
        } else
            AppSpecificFunctions::ShowNotedFeedback(\'Could not delete right now! Pleae try again.\',false);
    }';
        return $code;
    }
    protected function getPageFormTemplate_btnCancelObject_Clicked_Function($objectName) {
        $code = '
    protected function btnCancel'.$objectName.'_Clicked($strFormId, $strControlId, $strParameter) {
        // Nothing happens here
    }';
        return $code;
    }
    protected function getPageFormTemplate_executeParentFunction_Function($objectName) {
        $code = '
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = \'window.parent.window.executeFormAction(\\\'\'.$parentFormId.\'\\\',\\\'\'.$strControlId.\'\\\',\\\'\'.$strParameter.\'\\\');\';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }';
        return $code;
    }
    protected function getPageDraft_Detail_Additional_Controller_Functions($objectName) {
        $code = '';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            //TODO: Support more renders here...
            $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
            if ($attrSpecialRender) {
                if (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                    $code .= '
    protected function btn'.$attr.'_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->'.$objectName.'Instance->getControlId(\''.$attr.'\'))->Toggle(!$this->GetControl($this->'.$objectName.'Instance->getControlId(\''.$attr.'\'))->IsToggled);
    }

    ';
                }
            }
        }

        return $code;
    }
    protected function getPageDraft_Detail_Class_End($objectName) {
        $code = '
}
'.$objectName.'_DetailForm::Run(\''.$objectName.'_DetailForm\');
?>';
        return $code;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Helper functions
    protected function getCamelCaseSplitArray($inputWord) {
        $re = '/(?#! splitCamelCase Rev:20140412)
                # Split camelCase "words". Two global alternatives. Either g1of2:
                  (?<=[a-z])      # Position is after a lowercase,
                  (?=[A-Z])       # and before an uppercase letter.
                | (?<=[A-Z])      # Or g2of2; Position is after uppercase,
                  (?=[A-Z][a-z])  # and before upper-then-lower case.
                /x';
        $WordArray = preg_split($re, $inputWord);
        return $WordArray;
    }
    protected function getCamelCaseSplitted($inputWord) {
        $returnWord = '';
        foreach ($this->getCamelCaseSplitArray($inputWord) as $word) {
            $returnWord .= $word.' ';
        }
        return substr($returnWord,0,strlen($returnWord)-1);
    }
    protected function getSpecialRenderListItems($SpecialRenderList) {
        if (is_array($SpecialRenderList)) {
            return array_slice($SpecialRenderList,1);
        }
        return null;
    }
    protected function getSpecialRenderInputGroup($SpecialRenderList,$before = true) {
        if (is_array($SpecialRenderList)) {
            if ($before) {
                return $SpecialRenderList[1];
            } else {
                return $SpecialRenderList[2];
            }
        }
        return null;
    }
    protected function getSpecialRenderButtonToggle($SpecialRenderList,$trueValue = true) {
        if (is_array($SpecialRenderList)) {
            if ($trueValue) {
                if (isset($SpecialRenderList[1]))
                    return $SpecialRenderList[1];
            } else {
                if (isset($SpecialRenderList[2]))
                    return $SpecialRenderList[2];
            }
        }
        return null;
    }

    protected function getAttributeDeclarationString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrDeclaration = 'public $txt'.$attr.';
    ';
        if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
            $attrDeclaration .= 'public $lst'.$attr.'Hours,$lst'.$attr.'Minutes;
    ';
        }
        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrDeclaration = 'public $lst'.$attr.';
    ';
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a list
                $attrDeclaration = 'public $btn'.$attr.';
    ';
            }
        }
        return $attrDeclaration;
    }
    protected function getAttributeString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrString = '$this->txt'.$attr;
        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrString = '$this->lst'.$attr;
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a list
                $attrString = '$this->btn'.$attr;
            }
        }
        return $attrString;
    }
    protected function getAttributeInitString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrInitString = $this->getAttributeString($objectName,$attr).' = new QTextBox($objParentObject);
        '.$this->getAttributeString($objectName,$attr).'->Name = \''.$this->getCamelCaseSplitted($attr).'\';';

        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrInitString = $this->getAttributeString($objectName,$attr).' = new QListBox($objParentObject);
        '.$this->getAttributeString($objectName,$attr).'->Name = \''.$this->getCamelCaseSplitted($attr).'\';
        '.$this->getAttributeString($objectName,$attr).'->DisplayStyle = QDisplayStyle::Block;
        '.$this->getAttributeString($objectName,$attr).'->AddCssClass(\'fullWidth\');';
            } elseif (in_array('INPUT_GROUP',$attrSpecialRender)) {
                $attrInitString = $this->getAttributeString($objectName,$attr).' = new QTextBox($objParentObject);
        '.$this->getAttributeString($objectName,$attr).'->Name = \''.$this->getCamelCaseSplitted($attr).'\';
        '.$this->getAttributeString($objectName,$attr).'->RenderAsInputGroup(true,\''.$this->getSpecialRenderInputGroup($attrSpecialRender,true).'\',\''.$this->getSpecialRenderInputGroup($attrSpecialRender,false).'\');';
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a button
                $attrInitString = $this->getAttributeString($objectName,$attr).' = new QButton($objParentObject);
        '.$this->getAttributeString($objectName,$attr).'->Name = \''.$this->getCamelCaseSplitted($attr).'\';
        '.$this->getAttributeString($objectName,$attr).'->HtmlEntities = false;
        $trueLabel = \''.$this->getSpecialRenderButtonToggle($attrSpecialRender,true).'\';
        $falseLabel = \''.$this->getSpecialRenderButtonToggle($attrSpecialRender,false).'\';
        if (strlen($trueLabel) < 1)
            $trueLabel = null;
        if (strlen($falseLabel) < 1)
            $falseLabel = null;
        '.$this->getAttributeString($objectName,$attr).'->setAsToggle(true,$trueLabel,$falseLabel);
        '.$this->getAttributeString($objectName,$attr).'->DisplayStyle = QDisplayStyle::Block;
        '.$this->getAttributeString($objectName,$attr).'->AddAction(new QClickEvent(), new QAjaxAction(\'btn'.$attr.'_Clicked\'));//btn'.$attr.'_Clicked must be implemented in Page Controller class (QForm class)';
            }
        }
        return $attrInitString;
    }
    protected function getAttributeDefaultString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrDefaultString = $this->getAttributeString($objectName,$attr).'->Text = \'\';';

        if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
            $attrDefaultString .= '
        $this->set'.$attr.'Time();';
        }

        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrDefaultString = $this->getAttributeString($objectName,$attr).'->RemoveAllItems();
        ';
                foreach ($this->getSpecialRenderListItems($attrSpecialRender) as $item) {
                    $attrDefaultString .= $this->getAttributeString($objectName,$attr).'->AddItem(new QListItem(\''.$item.'\',\''.$item.'\'));
        ';
                }
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                $attrDefaultString = '
        '.$this->getAttributeString($objectName,$attr).'->IsToggled = false;';
            }
        }
        return $attrDefaultString;
    }
    protected function getAttributeAssignedString($objectName,$attr,$objectAttrValue) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrAssignedString = 'if (!is_null($Object->'.$attr.')) {
            '.$this->getAttributeString($objectName,$attr).'->Text = '.$objectAttrValue.';';
        if ($this->dataModel->getObjectAttributeType($objectName,$attr) == 'DATETIME') {
            $attrAssignedString .= '
            $this->set'.$attr.'Time($Object->'.$attr.');';
        }
        $attrAssignedString .= '
        }
        ';
        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrAssignedString = 'if ($Object->'.$attr.') {
            '.$this->getAttributeString($objectName,$attr).'->SelectedValue = '.$objectAttrValue.';
        }
        ';
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a list
                $attrAssignedString = 'if ($Object->'.$attr.' == 1) {
            '.$this->getAttributeString($objectName,$attr).'->Toggle();
        } else {
            '.$this->getAttributeString($objectName,$attr).'->Toggle(false);
        }
        ';
            }
        }
        return $attrAssignedString;
    }
    protected function getAttributeSetValueString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrValueString = '$this->txt'.$attr.'->Text';
        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrValueString = $this->getAttributeString($objectName,$attr).'->SelectedValue';
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a list
                $attrValueString = $this->getAttributeString($objectName,$attr).'->IsToggled';
            }
        }
        return $attrValueString;
    }
    protected function getAttributeGetValueString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrValueString = '$this->txt'.$attr.'->Text';
        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrValueString = $this->getAttributeString($objectName,$attr).'->SelectedValue';
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a button
                $attrValueString = $this->getAttributeString($objectName,$attr).'->IsToggled?1:0';
            }
        }
        return $attrValueString;
    }
    protected function getAttributeValidationString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrValidationString = '
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired('.$this->getAttributeString($objectName,$attr).');';
        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrValidationString = '
        // Example of validating a field as required
        //AppSpecificFunctions::ExecuteJavaScript(\'removeValidationStateFromInput(\'\'.$this->txtUsername->getJqControlId().\'\')\');
        /*if (!'.$this->getAttributeString($objectName,$attr).'->SelectedValue){
            AppSpecificFunctions::ExecuteJavaScript(\'addValidationStateToInput(\'\'.$this->txtUsername->getJqControlId().\'\',\'Required\')\');
            $hasNoErrors = false;
        }*/';
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a button
                $attrValidationString = '';
            }
        }
        return $attrValidationString;
    }
    protected function getAttributeResetValidationString($objectName,$attr) {
        //TODO: Support more renders here...
        $attrSpecialRender = $this->dataModel->getObjectAttributeSpecialRenders($objectName,$attr);
        $attrResetValidationString = '
            '.$this->getAttributeString($objectName,$attr).'->WrapperCssClass = \'form-group\';
            '.$this->getAttributeString($objectName,$attr).'->Placeholder = \'\';';
        if ($attrSpecialRender) {
            if (in_array('LIST',$attrSpecialRender)) {
                // Render as a list
                $attrResetValidationString = '
            '.$this->getAttributeString($objectName,$attr).'->WrapperCssClass = \'form-group\';';
            } elseif (in_array('BUTTON_TOGGLE',$attrSpecialRender)) {
                // Render as a list
                $attrResetValidationString = '';
            }
        }
        return $attrResetValidationString;
    }

    protected function getAttributeInputParameterList($objectName) {
        $code = '';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '$'.$attr.' = \'\',';
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '$'.$attr.'_Id = \'\',';
            }
        }
        return substr($code,0,strlen($code)-1);
    }
    protected function getAttributeListForAPI($objectName) {
        $code = '';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '$'.$attr.',';
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '$'.$attr.'_Id,';
            }
        }
        return substr($code,0,strlen($code)-1);
    }
    protected function getAttributeDeclarationForAPI($objectName,$variablePrefix = 'new') {
        $code ='';
        foreach ($this->dataModel->getObjectAttributes($objectName) as $attr) {
            $code .= '
        if (strlen($'.$attr.') > 0)
            $'.$variablePrefix.$objectName.'Obj->'.$attr.' = $'.$attr.';';
        }
        if ($this->dataModel->getObjectSingleRelations($objectName)) {
            foreach ($this->dataModel->getObjectSingleRelations($objectName) as $attr) {
                $code .= '
        $'.$attr.'ObjToAssociate = '.$attr.'::Load($'.$attr.'_Id);
        if ($'.$attr.'ObjToAssociate)
            $'.$variablePrefix.$objectName.'Obj->'.$attr.'Object = $'.$attr.'ObjToAssociate;';
            }
        }
        return $code;
    }
}
sDevORMGenerationForm::Run('sDevORMGenerationForm');
?>

