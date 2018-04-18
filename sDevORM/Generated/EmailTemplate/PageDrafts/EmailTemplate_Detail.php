<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplate/EmailTemplateController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplate_DetailForm extends QForm {
    // EmailTemplate Object variables
    protected $EmailTemplateInstance;
    protected $btnSaveEmailTemplate,$btnDeleteEmailTemplate,$btnCancelEmailTemplate;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailTemplateInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = EmailTemplate::Load($objId);
            if ($theObject) {
                $this->EmailTemplateInstance->setObject($theObject);
                $this->EmailTemplateInstance->setValues($theObject);
                $this->EmailTemplateInstance->refreshAll();
                $this->btnDeleteEmailTemplate->Visible = true;
            } else {
                $this->EmailTemplateInstance->setObject(null);
                $this->EmailTemplateInstance->setValues(null);
                $this->btnDeleteEmailTemplate->Visible = false;
            }
        } else {
            $this->EmailTemplateInstance->setObject(null);
            $this->EmailTemplateInstance->setValues(null);
            $this->btnDeleteEmailTemplate->Visible = false;
        }
    }
    protected function InitEmailTemplateInstance() {
        $this->EmailTemplateInstance = new EmailTemplateController($this);

        $this->btnSaveEmailTemplate = new QButton($this);
        $this->btnSaveEmailTemplate->Text = 'Save';
        $this->btnSaveEmailTemplate->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailTemplate_Clicked'));

        $this->btnDeleteEmailTemplate = new QButton($this);
        $this->btnDeleteEmailTemplate->Text = 'Delete';
        $this->btnDeleteEmailTemplate->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteEmailTemplate->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailTemplate_Clicked'));

        $this->btnCancelEmailTemplate = new QButton($this);
        $this->btnCancelEmailTemplate->Text = 'Cancel';
        $this->btnCancelEmailTemplate->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEmailTemplate_Clicked'));
    }
    protected function btnSaveEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
    protected function btnPublished_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->Toggle(!$this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->IsToggled);
    }

    
}
EmailTemplate_DetailForm::Run('EmailTemplate_DetailForm');
?>