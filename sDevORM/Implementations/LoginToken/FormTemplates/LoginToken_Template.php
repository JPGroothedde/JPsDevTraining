<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/LoginToken/LoginTokenController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class LoginToken_DetailForm extends QForm {
    // LoginToken Object variables
    protected $LoginTokenInstance;
    protected $btnSaveLoginToken,$btnDeleteLoginToken,$btnCancelLoginToken;

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

        $this->InitLoginTokenInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = LoginToken::Load($objId);
            if ($theObject) {
                $this->LoginTokenInstance->setObject($theObject);
                $this->LoginTokenInstance->setValues($theObject);
                $this->LoginTokenInstance->refreshAll();
                $this->btnDeleteLoginToken->Visible = true;
            } else {
                $this->LoginTokenInstance->setObject(null);
                $this->LoginTokenInstance->setValues(null);
                $this->btnDeleteLoginToken->Visible = false;
            }
        } else {
            $this->LoginTokenInstance->setObject(null);
            $this->LoginTokenInstance->setValues(null);
            $this->btnDeleteLoginToken->Visible = false;
        }
    }
    protected function InitLoginTokenInstance() {
        $this->LoginTokenInstance = new LoginTokenController($this);

        $this->btnSaveLoginToken = new QButton($this);
        $this->btnSaveLoginToken->Text = 'Save LoginToken';
        $this->btnSaveLoginToken->AddAction(new QClickEvent(), new QAjaxAction('btnSaveLoginToken_Clicked'));

        $this->btnDeleteLoginToken = new QButton($this);
        $this->btnDeleteLoginToken->Text = 'Delete LoginToken';
        $this->btnDeleteLoginToken->CssClass = 'btn btn-danger';
        $this->btnDeleteLoginToken->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteLoginToken->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteLoginToken_Clicked'));

        $this->btnCancelLoginToken = new QButton($this);
        $this->btnCancelLoginToken->Text = 'Cancel';
        $this->btnCancelLoginToken->CssClass = 'btn btn-default';
        $this->btnCancelLoginToken->AddAction(new QClickEvent(), new QAjaxAction('btnCancelLoginToken_Clicked'));
    }
    protected function btnSaveLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LoginTokenInstance->saveObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LoginTokenInstance->deleteObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        QApplication::Redirect(loadPreviousPage());
    }
}
LoginToken_DetailForm::Run('LoginToken_DetailForm');
?>