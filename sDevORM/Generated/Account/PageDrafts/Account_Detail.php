<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Account/AccountController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Account_DetailForm extends QForm {
    // Account Object variables
    protected $AccountInstance;
    protected $btnSaveAccount,$btnDeleteAccount,$btnCancelAccount;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitAccountInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Account::Load($objId);
            if ($theObject) {
                $this->AccountInstance->setObject($theObject);
                $this->AccountInstance->setValues($theObject);
                $this->AccountInstance->refreshAll();
                $this->btnDeleteAccount->Visible = true;
            } else {
                $this->AccountInstance->setObject(null);
                $this->AccountInstance->setValues(null);
                $this->btnDeleteAccount->Visible = false;
            }
        } else {
            $this->AccountInstance->setObject(null);
            $this->AccountInstance->setValues(null);
            $this->btnDeleteAccount->Visible = false;
        }
    }
    protected function InitAccountInstance() {
        $this->AccountInstance = new AccountController($this);

        $this->btnSaveAccount = new QButton($this);
        $this->btnSaveAccount->Text = 'Save';
        $this->btnSaveAccount->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveAccount->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAccount_Clicked'));

        $this->btnDeleteAccount = new QButton($this);
        $this->btnDeleteAccount->Text = 'Delete';
        $this->btnDeleteAccount->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteAccount->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAccount->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAccount_Clicked'));

        $this->btnCancelAccount = new QButton($this);
        $this->btnCancelAccount->Text = 'Cancel';
        $this->btnCancelAccount->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelAccount->AddAction(new QClickEvent(), new QAjaxAction('btnCancelAccount_Clicked'));
    }
    protected function btnSaveAccount_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AccountInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteAccount_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AccountInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelAccount_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Account_DetailForm::Run('Account_DetailForm');
?>