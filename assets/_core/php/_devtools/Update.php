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
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();
class UpdateForm extends QForm {
	protected $UpdateSize = 'Could not be retrieved (<i>Ensure that your license key and current version are valid</i>)';
	protected $LatestVersion = 'Could not be retrieved (<i>Ensure that your license key is valid</i>)';
	protected $btnUpdateNow;
	protected $UpdateFileList;
	protected $html_UpdateFeedback;
	protected $html_UpdateIssues,$IssueFileArray = array();
	public function Form_Create() {
		parent::Form_Create();
		$this->UpdateFileList = array();
		$data = array("APIKEY" => SDEV_LICENSE,"ChangedFile_CompareVersion" => __SDEVBASE_VERSION__);
		$ReadResult_UpdateSize = AppSpecificFunctions::CallsDevAPI('GETCHANGEDFILESSINCEVERSION','https://distribution.stratusolvecloud.com/API/Object/ChangedFile.php/',$data,'u','p');
		$resultArray_UpdateSize = json_decode($ReadResult_UpdateSize);
		if ($resultArray_UpdateSize) {
			if ($resultArray_UpdateSize->Result == 'Success') {
				$this->UpdateSize = sizeof($resultArray_UpdateSize->ObjArray).' Files';
				if (sizeof($resultArray_UpdateSize->ObjArray) > 0)
					$this->UpdateFileList = $resultArray_UpdateSize->ObjArray;
			}
		}
		
		$data = array("APIKEY" => SDEV_LICENSE);
		$ReadResult = AppSpecificFunctions::CallsDevAPI('GETLATESTVERSION','https://distribution.stratusolvecloud.com/API/Object/sDevVersion.php/',$data,'u','p');
		$resultArray = json_decode($ReadResult);
		if ($resultArray) {
			if ($resultArray->Result == 'Success') {
				$this->LatestVersion = $resultArray->Version;
			}
		}
		
		$this->btnUpdateNow = AppSpecificFunctions::getNewActionButton($this,'Update Now','btn btn-primary rippleclick','handleDoUpdate',true,'Please ensure that your current project is fully backed up before proceeding...');
		$this->html_UpdateFeedback = new sUIElementsBase($this);
		$this->html_UpdateIssues = new sUIElementsBase($this);
	}
	
	protected function handleDoUpdate() {
		$AllSuccess = true;
		$this->IssueFileArray = array();
		$html = '<h4 class="page-header">Update Result</h4>
					<div class="row">
					    <div class="col-xs-12">
					        <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="UpdatedFiles_Updated-Files">
						      <h4 class="panel-title">
						        <a class="accordion-toggle collapsed" role="button" data-toggle="collapse" href="#collapseUpdatedFiles_Updated-Files" aria-expanded="true" aria-controls="collapseUpdatedFiles_Updated-Files">
						          Updated Files
						        </a>
						      </h4>
						    </div>
						    <div id="collapseUpdatedFiles_Updated-Files" class="panel-collapse collapse " role="tabpanel" aria-labelledby="UpdatedFiles_Updated-Files">
						      <div class="panel-body">
						      	<ul class="list-group">';
		foreach ($this->UpdateFileList as $FileToUpdate) {
			if ($this->updateFileFromServer($FileToUpdate->PathRelativeToDocRoot,$FileToUpdate->Id,$FileToUpdate->Action)) {
				$html .= '<li class="list-group-item">
				    <span class="badge" style="background-color: #00AA00">Updated</span>
				    <span class="badge">'.$FileToUpdate->Action.'</span>
				    '.$FileToUpdate->PathRelativeToDocRoot.'
				  </li>';
			} else {
				$html .= '<li class="list-group-item">
				    <span class="badge" style="background-color: #e71600">Update Failed</span>
				    <span class="badge">'.$FileToUpdate->Action. '</span>
				    ' .$FileToUpdate->PathRelativeToDocRoot.'
				  </li>';
				$AllSuccess = false;
			}
		}
		$html .= '</ul>
				      </div>
				    </div>
				</div>
			    </div>
			</div>

';
		if (sizeof($this->IssueFileArray) > 0) {
			$IssueHtml = '<p>The following sensitive files were updated and might cause problems in your project if not reviewed:</p>';
			foreach ($this->IssueFileArray as $Issue) {
				$IssueHtml .= '<strong>'.$Issue.'</strong><br><br>';
			}
			$this->html_UpdateIssues->updateControl($IssueHtml);
			AppSpecificFunctions::ToggleModal('UpdateIssues');
		}
		if ($AllSuccess) {
			if ($this->LatestVersion != 'Could not be retrieved (<i>Ensure that your license key is valid</i>)') {
				$sDevVersionConfig = fopen(__DOCROOT__.__SUBDIRECTORY__.'/includes/configuration/ConfigurationComponents/sdev_version_config.inc.php', "w+");
				$sDevVersionCode = '<?php
define(\'__SDEVBASE_VERSION__\',\''.$this->LatestVersion.'\');
?>';
				fwrite($sDevVersionConfig, $sDevVersionCode);
				fclose($sDevVersionConfig);
			}
		}
		$this->html_UpdateFeedback->updateControl($html);
	}
	protected function updateFileFromServer($FilePathRelativeToDocRoot = null,$ChangedFileId = null, $Action = 'MODIFIED') {
		if (!$FilePathRelativeToDocRoot)
			return false;
		if ($this->LatestVersion == 'Could not be retrieved (<i>Ensure that your license key is valid</i>)')
			return false;
		if (!$ChangedFileId)
			return false;
		if ($Action == 'DELETED') {
			if (file_exists(__DOCROOT__.__SUBDIRECTORY__.$FilePathRelativeToDocRoot))
				unlink(__DOCROOT__.__SUBDIRECTORY__.$FilePathRelativeToDocRoot);
			return true;
		}
		$FolderArray = explode('/',$FilePathRelativeToDocRoot);
		$CurrentFolder = '';
		foreach ($FolderArray as $FolderOrFile) {
			if (strpos($FolderOrFile,'.') !== false)
				break;
			$CurrentFolder .= '/'.$FolderOrFile;
			if (!file_exists(__DOCROOT__.__SUBDIRECTORY__.$CurrentFolder))
				mkdir(__DOCROOT__.__SUBDIRECTORY__.$CurrentFolder, 0755, true);
		}
		$data = array("APIKEY" => SDEV_LICENSE,"ChangedFileId" => $ChangedFileId);
		$ReadResult_FileContent = AppSpecificFunctions::CallsDevAPI('GETCHANGEDFILECONTENT','https://distribution.stratusolvecloud.com/API/Object/ChangedFile.php/',$data,'u','p');
		$resultArray_FileContent = json_decode($ReadResult_FileContent);
		$SensitiveFileArray = array('DATAMODEL.CLASS','DATAMODEL_BASE.CLASS','CONFIG','FOOTER','HEADER','STANDARD_SCRIPTS');
		if ($resultArray_FileContent) {
			if ($resultArray_FileContent->Result == 'Success') {
				$CurrentContent = '';
				if (file_exists(__DOCROOT__.__SUBDIRECTORY__.$FilePathRelativeToDocRoot)) {
					$CurrentContent = file_get_contents(__DOCROOT__.__SUBDIRECTORY__.$FilePathRelativeToDocRoot);
				}
				$fp = fopen (__DOCROOT__.__SUBDIRECTORY__.$FilePathRelativeToDocRoot, 'w+');
				if (strlen($CurrentContent) > 0) {
					foreach ($SensitiveFileArray as $Keyword) {
						if (strpos(strtoupper($FilePathRelativeToDocRoot),'SDEV_VERSION_CONFIG.INC.PHP') !== false)
							break;
						if (strpos(strtoupper($FilePathRelativeToDocRoot),$Keyword) !== false) {
							if (!in_array($FilePathRelativeToDocRoot,$this->IssueFileArray)) {
								array_push($this->IssueFileArray,$FilePathRelativeToDocRoot);
							}
						}
					}
				}
				fwrite($fp, $resultArray_FileContent->Contents);
				fclose($fp);
				return true;
			}
		}
		return false;
	}
	
}
UpdateForm::Run('UpdateForm');

?>