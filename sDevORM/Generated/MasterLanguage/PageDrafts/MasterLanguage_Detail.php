<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/MasterLanguage/MasterLanguageController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class MasterLanguage_DetailForm extends QForm {
    // MasterLanguage Object variables
    protected $MasterLanguageInstance;
    protected $btnSaveMasterLanguage,$btnDeleteMasterLanguage,$btnCancelMasterLanguage;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitMasterLanguageInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = MasterLanguage::Load($objId);
            if ($theObject) {
                $this->MasterLanguageInstance->setObject($theObject);
                $this->MasterLanguageInstance->setValues($theObject);
                $this->MasterLanguageInstance->refreshAll();
                $this->btnDeleteMasterLanguage->Visible = true;
            } else {
                $this->MasterLanguageInstance->setObject(null);
                $this->MasterLanguageInstance->setValues(null);
                $this->btnDeleteMasterLanguage->Visible = false;
            }
        } else {
            $this->MasterLanguageInstance->setObject(null);
            $this->MasterLanguageInstance->setValues(null);
            $this->btnDeleteMasterLanguage->Visible = false;
        }
    }
    protected function InitMasterLanguageInstance() {
        $this->MasterLanguageInstance = new MasterLanguageController($this);

        $this->btnSaveMasterLanguage = new QButton($this);
        $this->btnSaveMasterLanguage->Text = 'Save';
        $this->btnSaveMasterLanguage->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveMasterLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnSaveMasterLanguage_Clicked'));

        $this->btnDeleteMasterLanguage = new QButton($this);
        $this->btnDeleteMasterLanguage->Text = 'Delete';
        $this->btnDeleteMasterLanguage->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteMasterLanguage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteMasterLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteMasterLanguage_Clicked'));

        $this->btnCancelMasterLanguage = new QButton($this);
        $this->btnCancelMasterLanguage->Text = 'Cancel';
        $this->btnCancelMasterLanguage->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelMasterLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnCancelMasterLanguage_Clicked'));
    }
    protected function btnSaveMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->MasterLanguageInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->MasterLanguageInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
MasterLanguage_DetailForm::Run('MasterLanguage_DetailForm');
?>