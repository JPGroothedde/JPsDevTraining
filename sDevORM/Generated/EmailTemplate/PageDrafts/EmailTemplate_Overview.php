<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplate/EmailTemplateController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailTemplate/EmailTemplateDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplate_OverviewForm extends QForm {
    // Data grid variables
    protected $EmailTemplateGrid;
    protected $EmailTemplateWaitControlIcon;
    protected $btnNewEmailTemplate;
    protected $selectedEmailTemplateId = -1;

    // EmailTemplate Object variables
    protected $EmailTemplateInstance;
    protected $btnSaveEmailTemplate,$btnDeleteEmailTemplate;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailTemplateDataGrid();
        $this->InitEmailTemplateModal();
    }
    protected function InitEmailTemplateModal() {
        $this->EmailTemplateInstance = new EmailTemplateController($this);

        $this->btnSaveEmailTemplate = new QButton($this);
        $this->btnSaveEmailTemplate->Text = 'Save';
        $this->btnSaveEmailTemplate->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailTemplate_Clicked'));

        $this->btnDeleteEmailTemplate = new QButton($this);
        $this->btnDeleteEmailTemplate->Text = 'Delete';
        $this->btnDeleteEmailTemplate->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteEmailTemplate->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailTemplate_Clicked'));
    }
    protected function btnSaveEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateInstance->saveObject()) {
            $this->EmailTemplateGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailTemplateModal');
        }
    }
    protected function btnDeleteEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateInstance->deleteObject()) {
            $this->EmailTemplateGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailTemplateModal');
        }
    }
    protected function InitEmailTemplateDataGrid() {
        $searchableAttributes = array(QQN::EmailTemplate()->TemplateName,QQN::EmailTemplate()->CcAddresses,QQN::EmailTemplate()->BccAddresses,QQN::EmailTemplate()->Published);
        $headerItems = array('Template Name','Cc Addresses','Bcc Addresses','Published');
        $headerSortNodes = array(QQN::EmailTemplate()->TemplateName,QQN::EmailTemplate()->CcAddresses,QQN::EmailTemplate()->BccAddresses,QQN::EmailTemplate()->Published);
        $columnItems = array('TemplateName','CcAddresses','BccAddresses','Published');
        $this->EmailTemplateWaitControlIcon = new QWaitIcon($this);
        $this->btnNewEmailTemplate = new QButton($this);
        $this->btnNewEmailTemplate->Text = 'Add EmailTemplate';
        $this->btnNewEmailTemplate->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewEmailTemplate->AddAction(new QClickEvent(), new QAjaxAction('btnNewEmailTemplate_Clicked'));
        $this->EmailTemplateGrid = new EmailTemplateDataGrid($this, QQN::EmailTemplate(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->EmailTemplateWaitControlIcon, 'EmailTemplateGrid');
    }
    protected function EmailTemplateGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailTemplateId = $strParameter;
        $theObject = EmailTemplate::Load($this->selectedEmailTemplateId);
        if ($theObject) {
            $this->EmailTemplateInstance->setObject($theObject);
            $this->EmailTemplateInstance->setValues($theObject);
            $this->EmailTemplateInstance->refreshAll();
            $this->btnDeleteEmailTemplate->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailTemplateModal');
        }
    }
    protected function btnNewEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailTemplateId = -1;
        $this->EmailTemplateInstance->setObject(null);
        $this->EmailTemplateInstance->setValues(null);
        $this->btnDeleteEmailTemplate->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailTemplateModal');
    }
    protected function btnPublished_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->Toggle(!$this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->IsToggled);
    }

    
}
EmailTemplate_OverviewForm::Run('EmailTemplate_OverviewForm');
?>