<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 210415
 * Time: 10:44
 */
class attachmentUploader extends sFileUploader {
	public function __construct($objParentObject,$filePrefix = 'UploadedFile_',$actionName = 'HandleDocumentUpload') {
		parent::__construct($objParentObject,$filePrefix,$actionName);
	}
	public function HandleDocumentUpload($strFormId, $strControlId, $strParameter, $RefObj) {
		// RefObj can be an object that this FileDocument object needs to be associated with
		$uploadedArray = array();
		if (isset($_SESSION['FileUploaded'])) {
			$this->lastUploadedFileName = '';
			$this->lastUploadedFilePath = '';
			$fileUploadArray = $_SESSION['FileUploaded'];
			foreach ($fileUploadArray as $uploadedFile) {
				$theDocument = new FileDocument();
				$theDocument->FileName = $uploadedFile;
				$theDocument->Path = __FILE_UPLOADED_PATH__.$uploadedFile;
				$theDocument->CreatedDate = QDateTime::Now(true);
				//$theDocument->RefObj = $RefObj; //Example
				try {
					$theDocument->Save();
					array_push($uploadedArray,$theDocument);
					$this->FileUploaderCleanup();
					$this->lastUploadedFileName .= $theDocument->FileName.'<br>';
					$this->lastUploadedFilePath .= $theDocument->Path.'<br>';
				} catch (QCallerException $e) {
					AppSpecificFunctions::ShowNotedFeedback ('Could not save document. Please try again later.'.$e,false,true);
				}
				//AppSpecificFunctions::AddCustomLog($RefObj);
				$AttachmentObj = new PersonAttachment();
				$AttachmentObj->PersonObject = Person::Load($RefObj);
				$AttachmentObj->FileDocumentObject = $theDocument;
				try {
					$AttachmentObj->Save();
				} catch(QCallerException $e) {
				
				}
			}
		} else {
			AppSpecificFunctions::ShowNotedFeedback('Could save document. No file was uploaded.',false,true);
		}
		return $uploadedArray;
	}
}
?>