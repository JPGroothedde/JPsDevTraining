<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PersonLanguage/PersonLanguageController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonLanguage_DetailForm extends QForm {
    // PersonLanguage Object variables
    protected $PersonLanguageInstance;
    protected $btnSavePersonLanguage,$btnDeletePersonLanguage,$btnCancelPersonLanguage;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonLanguageInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PersonLanguage::Load($objId);
            if ($theObject) {
                $this->PersonLanguageInstance->setObject($theObject);
                $this->PersonLanguageInstance->setValues($theObject);
                $this->PersonLanguageInstance->refreshAll();
                $this->btnDeletePersonLanguage->Visible = true;
            } else {
                $this->PersonLanguageInstance->setObject(null);
                $this->PersonLanguageInstance->setValues(null);
                $this->btnDeletePersonLanguage->Visible = false;
            }
        } else {
            $this->PersonLanguageInstance->setObject(null);
            $this->PersonLanguageInstance->setValues(null);
            $this->btnDeletePersonLanguage->Visible = false;
        }
    }
    protected function InitPersonLanguageInstance() {
        $this->PersonLanguageInstance = new PersonLanguageController($this);

        $this->btnSavePersonLanguage = new QButton($this);
        $this->btnSavePersonLanguage->Text = 'Save';
        $this->btnSavePersonLanguage->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonLanguage_Clicked'));

        $this->btnDeletePersonLanguage = new QButton($this);
        $this->btnDeletePersonLanguage->Text = 'Delete';
        $this->btnDeletePersonLanguage->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePersonLanguage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonLanguage_Clicked'));

        $this->btnCancelPersonLanguage = new QButton($this);
        $this->btnCancelPersonLanguage->Text = 'Cancel';
        $this->btnCancelPersonLanguage->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPersonLanguage_Clicked'));
    }
    protected function btnSavePersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonLanguageInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeletePersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonLanguageInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelPersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
PersonLanguage_DetailForm::Run('PersonLanguage_DetailForm');
?>