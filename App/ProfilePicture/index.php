<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
require('ProfilePictureUploader.php');
AppSpecificFunctions::CheckRemoteAdmin();

class FileUploadForm extends QForm {
    protected $fileUploader;
    protected $sh_Feedback;
    protected $btnInvokeFileUpload,$btnSendToRemoteServer;
    protected $sendToRemote = false;
    protected $btnCancel;
    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->fileUploader = new ProfilePictureUploader($this,null,'fileUploaded');
        $this->sh_Feedback = new sUIElementsBase($this);
        $this->btnInvokeFileUpload = AppSpecificFunctions::getNewActionButton($this,'Force Upload','btn btn-default','InvokeFileUpload_Action');
        $this->btnSendToRemoteServer = AppSpecificFunctions::getNewActionButton($this,'Send File To Remote Server','btn btn-warning','btnSendToRemoteServer_Clicked');
        
        $this->btnCancel = new QButton($this);
        $this->btnCancel->Text = 'Cancel';
        $this->btnCancel->CssClass = 'btn btn-primary rippleclick fullWidth';
        $this->btnCancel->AddAction(new QClickEvent(), new QAjaxAction('btnCancel_Click'));
    }
    protected function fileUploaded($strFormId, $strControlId, $strParameter) {
        $uploadedArray = $this->fileUploader->HandleDocumentUpload($strFormId, $strControlId, $strParameter);
        $html = '<div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Result:</strong> The following files were uploaded: <br>';
        foreach ($uploadedArray as $file) {
            $html .= '<br>'.$file->Path;
            if ($this->sendToRemote) {
                if (file_exists($file->Path)) {
                    $html .= '<br> File Path to send: '.$file->Path;
                    if (AppSpecificFunctions::sendFile('ftp.stratusolve.com','stratpbwvq_2','ptUtcpYHU98',$file->Path,$file->FileName))
                        $html .= 'File Sent to ftp.stratusolve.com<br>';
                    else {
                        AppSpecificFunctions::ShowNotedFeedback('File could not be sent...');
                    }
                }
                elseif (file_exists(__DOCROOT__.$file->Path)) {
                    $html .= '<br> File Path to send: '.__DOCROOT__.$file->Path;
                    if (AppSpecificFunctions::sendFile('ftp.stratusolve.com','stratpbwvq_2','ptUtcpYHU98',__DOCROOT__.$file->Path,$file->FileName))
                        $html .= 'File Sent to ftp.stratusolve.com<br>';
                    else {
                        AppSpecificFunctions::ShowNotedFeedback('File could not be sent...');
                    }
                } else {
                    AppSpecificFunctions::ShowNotedFeedback('Could not find realpath for file to send');
                }
            }
        }
        $html .= '</div>';
        $this->sh_Feedback->updateControl($html);
    }
    protected function InvokeFileUpload_Action() {
        // A very useful way to invoke the file upload from say, the save button on a modal
        $this->fileUploader->invokeFileUpload();
    }

    protected function btnSendToRemoteServer_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::ShowNotedFeedback('Next file will be sent to stratusolve.com/sDev');
        $this->sendToRemote = true;
    }
	
	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		AppSpecificFunctions::Redirect(loadPreviousPage());
	}
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
FileUploadForm::Run('FileUploadForm');
?>