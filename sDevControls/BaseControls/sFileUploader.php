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

class sFileUploader {
    /**
     * @var simpleHTML
     */
    protected $sh_FileUploadIframe;
    /**
     * @var simpleHTML
     */
    protected $sh_FileUploadAction;

    /**
     * @var string
     */
    /**
     * @var string
     */
    protected $lastUploadedFileName,$lastUploadedFilePath;

    /**
     * @param $objParentObject The parent QForm that will render the uploader
     * @param string $filePrefix
     * @param string $actionName The name of the action to execute upon successful upload
     * @throws QCallerException
     */
    public function __construct($objParentObject,$filePrefix = 'UploadedFile_',$actionName = 'HandleDocumentUpload') {
        $this->sh_FileUploadIframe = new simpleHTML($objParentObject);
        $this->sh_FileUploadAction = new simpleHTML($objParentObject);
        $this->sh_FileUploadAction->AddAction(new QClickEvent(), new QAjaxAction($actionName));
        $html = '<iframe id="'.$this->sh_FileUploadIframe->getJqControlId().'_iframe" style="border:none;width:100%;height:80px;" scrolling="no"
                src="'.__SUBDIRECTORY__.'/FileUpload/index.php?f='.$filePrefix.'
                &formId='.$objParentObject->FormId.'&actionId='.$this->sh_FileUploadAction->getJqControlId().'"></iframe>';
        $this->sh_FileUploadIframe->updateControl($html);
        $this->lastUploadedFileName = '';
        $this->lastUploadedFilePath = '';
    }

    /**
     * @throws Exception
     * @throws QCallerException
     */
    public function renderUploader($printOutput = true) {
        return $this->sh_FileUploadIframe->Render($printOutput);
    }

    /**
     *
     */
    public function hideUploader() {
        $this->sh_FileUploadIframe->Visible = false;
        $this->sh_FileUploadIframe->Refresh();
    }

    /**
     *
     */
    public function showUploader() {
        $this->sh_FileUploadIframe->Visible = true;
        $this->sh_FileUploadIframe->Refresh();
    }

    /**
     *
     */
    protected function FileUploaderCleanup() {
        if (isset($_SESSION['FileUploaded']))
            unset($_SESSION['FileUploaded']);
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     * @return array
     */
    public function HandleDocumentUpload($strFormId, $strControlId, $strParameter/*, $RefObj*/) {
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
            }
        } else {
            AppSpecificFunctions::ShowNotedFeedback('Could save document. No file was uploaded.',false,true);
        }
        return $uploadedArray;
    }

    /**
     * @return string
     */
    public function getLastFileName() {
        return $this->lastUploadedFileName;
    }

    /**
     * @return string
     */
    public function getLastFilePath() {
        return $this->lastUploadedFilePath;
    }

    /**
     *
     */
    public function invokeFileUpload() {
        $js = 'document.getElementById(\''.$this->sh_FileUploadIframe->getJqControlId().'_iframe\').contentWindow.invokeUpload();';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
?>
