<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailMessage/EmailMessageController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailMessage_DetailForm extends QForm {
    // EmailMessage Object variables
    protected $EmailMessageInstance;
    protected $btnSaveEmailMessage,$btnDeleteEmailMessage,$btnCancelEmailMessage;

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

        $this->InitEmailMessageInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = EmailMessage::Load($objId);
            if ($theObject) {
                $this->EmailMessageInstance->setObject($theObject);
                $this->EmailMessageInstance->setValues($theObject);
                $this->EmailMessageInstance->refreshAll();
                $this->btnDeleteEmailMessage->Visible = true;
            } else {
                $this->EmailMessageInstance->setObject(null);
                $this->EmailMessageInstance->setValues(null);
                $this->btnDeleteEmailMessage->Visible = false;
            }
        } else {
            $this->EmailMessageInstance->setObject(null);
            $this->EmailMessageInstance->setValues(null);
            $this->btnDeleteEmailMessage->Visible = false;
        }
    }
    protected function InitEmailMessageInstance() {
        $this->EmailMessageInstance = new EmailMessageController($this);

        $this->btnSaveEmailMessage = new QButton($this);
        $this->btnSaveEmailMessage->Text = 'Save EmailMessage';
        $this->btnSaveEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailMessage_Clicked'));

        $this->btnDeleteEmailMessage = new QButton($this);
        $this->btnDeleteEmailMessage->Text = 'Delete EmailMessage';
        $this->btnDeleteEmailMessage->CssClass = 'btn btn-danger';
        $this->btnDeleteEmailMessage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailMessage_Clicked'));

        $this->btnCancelEmailMessage = new QButton($this);
        $this->btnCancelEmailMessage->Text = 'Cancel';
        $this->btnCancelEmailMessage->CssClass = 'btn btn-default';
        $this->btnCancelEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEmailMessage_Clicked'));
    }
    protected function btnSaveEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailMessageInstance->saveObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailMessageInstance->deleteObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        QApplication::Redirect(loadPreviousPage());
    }
}
EmailMessage_DetailForm::Run('EmailMessage_DetailForm');
?>