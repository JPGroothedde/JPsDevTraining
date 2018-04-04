<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ApiKey_DetailForm extends QForm {
    // ApiKey Object variables
    protected $ApiKeyInstance;
    protected $btnSaveApiKey,$btnDeleteApiKey,$btnCancelApiKey;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitApiKeyInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = ApiKey::Load($objId);
            if ($theObject) {
                $this->ApiKeyInstance->setObject($theObject);
                $this->ApiKeyInstance->setValues($theObject);
                $this->ApiKeyInstance->refreshAll();
                $this->btnDeleteApiKey->Visible = true;
            } else {
                $this->ApiKeyInstance->setObject(null);
                $this->ApiKeyInstance->setValues(null);
                $this->btnDeleteApiKey->Visible = false;
            }
        } else {
            $this->ApiKeyInstance->setObject(null);
            $this->ApiKeyInstance->setValues(null);
            $this->btnDeleteApiKey->Visible = false;
        }
    }
    protected function InitApiKeyInstance() {
        $this->ApiKeyInstance = new ApiKeyController($this);

        $this->btnSaveApiKey = new QButton($this);
        $this->btnSaveApiKey->Text = 'Save';
        $this->btnSaveApiKey->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnSaveApiKey_Clicked'));

        $this->btnDeleteApiKey = new QButton($this);
        $this->btnDeleteApiKey->Text = 'Delete';
        $this->btnDeleteApiKey->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteApiKey->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteApiKey_Clicked'));

        $this->btnCancelApiKey = new QButton($this);
        $this->btnCancelApiKey->Text = 'Cancel';
        $this->btnCancelApiKey->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnCancelApiKey_Clicked'));
    }
    protected function btnSaveApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiKeyInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiKeyInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
ApiKey_DetailForm::Run('ApiKey_DetailForm');
?>