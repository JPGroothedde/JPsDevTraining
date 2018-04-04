<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/FileDocument/FileDocumentController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class FileDocument_DetailForm extends QForm {
    // FileDocument Object variables
    protected $FileDocumentInstance;
    protected $btnSaveFileDocument,$btnDeleteFileDocument,$btnCancelFileDocument;

    //Mobile detection
    protected $deviceType;
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        $detect = new Mobile_Detect;
        $this->deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        if ($this->deviceType == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitFileDocumentInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = FileDocument::Load($objId);
            if ($theObject) {
                $this->FileDocumentInstance->setObject($theObject);
                $this->FileDocumentInstance->setValues($theObject);
                $this->FileDocumentInstance->refreshAll();
                $this->btnDeleteFileDocument->Visible = true;
            } else {
                $this->FileDocumentInstance->setObject(null);
                $this->FileDocumentInstance->setValues(null);
                $this->btnDeleteFileDocument->Visible = false;
            }
        } else {
            $this->FileDocumentInstance->setObject(null);
            $this->FileDocumentInstance->setValues(null);
            $this->btnDeleteFileDocument->Visible = false;
        }
    }
    protected function InitFileDocumentInstance() {
        $this->FileDocumentInstance = new FileDocumentController($this);

        $this->btnSaveFileDocument = new QButton($this);
        $this->btnSaveFileDocument->Text = 'Save FileDocument';
        $this->btnSaveFileDocument->AddAction(new QClickEvent(), new QAjaxAction('btnSaveFileDocument_Clicked'));

        $this->btnDeleteFileDocument = new QButton($this);
        $this->btnDeleteFileDocument->Text = 'Delete FileDocument';
        $this->btnDeleteFileDocument->CssClass = 'btn btn-danger';
        $this->btnDeleteFileDocument->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteFileDocument->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteFileDocument_Clicked'));

        $this->btnCancelFileDocument = new QButton($this);
        $this->btnCancelFileDocument->Text = 'Cancel';
        $this->btnCancelFileDocument->CssClass = 'btn btn-default';
        $this->btnCancelFileDocument->AddAction(new QClickEvent(), new QAjaxAction('btnCancelFileDocument_Clicked'));
    }
    protected function btnSaveFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->FileDocumentInstance->saveObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->FileDocumentInstance->deleteObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        QApplication::Redirect(loadPreviousPage());
    }
}
FileDocument_DetailForm::Run('FileDocument_DetailForm');
?>