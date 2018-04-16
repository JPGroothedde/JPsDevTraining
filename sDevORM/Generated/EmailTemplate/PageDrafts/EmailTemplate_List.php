<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplate/EmailTemplateController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailTemplate/EmailTemplateDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplate_ListForm extends QForm {
    // Data list variables
    protected $EmailTemplateList;
    protected $btnNewEmailTemplate;

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

        $this->InitEmailTemplateDataList();
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
            $this->EmailTemplateList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailTemplateModal');
        }
    }
    protected function btnDeleteEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateInstance->deleteObject()) {
            $this->EmailTemplateList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailTemplateModal');
        }
    }
    protected function InitEmailTemplateDataList() {
        $searchableAttributes = array(QQN::EmailTemplate()->TemplateName,QQN::EmailTemplate()->CcAddresses,QQN::EmailTemplate()->BccAddresses,QQN::EmailTemplate()->Published);
        $SortAttributesShown = array('Template Name','Cc Addresses','Bcc Addresses','Published');
        $SortAttributes = array(QQN::EmailTemplate()->TemplateName,QQN::EmailTemplate()->CcAddresses,QQN::EmailTemplate()->BccAddresses,QQN::EmailTemplate()->Published);
        $columnItems = array('TemplateName','CcAddresses','BccAddresses','Published');
        $this->btnNewEmailTemplate = AppSpecificFunctions::getNewActionButton($this,'Add EmailTemplate','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewEmailTemplate_Clicked');
        $this->EmailTemplateList = new EmailTemplateDataList($this, QQN::EmailTemplate(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function EmailTemplate_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateList->getActiveId() != $strParameter)
                $this->EmailTemplateList->setActiveId($strParameter);
            else
                $this->EmailTemplateList->setActiveId(null);
        $theObject = EmailTemplate::Load($strParameter);
        if ($theObject) {
            $this->EmailTemplateInstance->setObject($theObject);
            $this->EmailTemplateInstance->setValues($theObject);
            $this->EmailTemplateInstance->refreshAll();
            $this->btnDeleteEmailTemplate->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailTemplateModal');
        }
    }
    protected function EmailTemplate_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplate_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplate_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplate_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplate_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewEmailTemplate_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateList->setActiveId(null);
        $this->EmailTemplateInstance->setObject(null);
        $this->EmailTemplateInstance->setValues(null);
        $this->btnDeleteEmailTemplate->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailTemplateModal');
    }
    protected function btnPublished_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->Toggle(!$this->GetControl($this->EmailTemplateInstance->getControlId('Published'))->IsToggled);
    }

    
}
EmailTemplate_ListForm::Run('EmailTemplate_ListForm');
?>