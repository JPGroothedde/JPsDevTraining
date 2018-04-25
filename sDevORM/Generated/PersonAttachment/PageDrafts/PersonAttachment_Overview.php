<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PersonAttachment/PersonAttachmentController.php');
require(__SDEV_CONTROLS__.'/Implementations/PersonAttachment/PersonAttachmentDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonAttachment_OverviewForm extends QForm {
    // Data grid variables
    protected $PersonAttachmentGrid;
    protected $PersonAttachmentWaitControlIcon;
    protected $btnNewPersonAttachment;
    protected $selectedPersonAttachmentId = -1;

    // PersonAttachment Object variables
    protected $PersonAttachmentInstance;
    protected $btnSavePersonAttachment,$btnDeletePersonAttachment;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonAttachmentDataGrid();
        $this->InitPersonAttachmentModal();
    }
    protected function InitPersonAttachmentModal() {
        $this->PersonAttachmentInstance = new PersonAttachmentController($this);

        $this->btnSavePersonAttachment = new QButton($this);
        $this->btnSavePersonAttachment->Text = 'Save';
        $this->btnSavePersonAttachment->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonAttachment_Clicked'));

        $this->btnDeletePersonAttachment = new QButton($this);
        $this->btnDeletePersonAttachment->Text = 'Delete';
        $this->btnDeletePersonAttachment->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePersonAttachment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonAttachment_Clicked'));
    }
    protected function btnSavePersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonAttachmentInstance->saveObject()) {
            $this->PersonAttachmentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
        }
    }
    protected function btnDeletePersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonAttachmentInstance->deleteObject()) {
            $this->PersonAttachmentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
        }
    }
    protected function InitPersonAttachmentDataGrid() {
        $searchableAttributes = array(QQN::PersonAttachment()->Name,QQN::PersonAttachment()->PersonObject->Id,QQN::PersonAttachment()->FileDocumentObject->Id);
        $headerItems = array('Name','Person Object','File Document Object');
        $headerSortNodes = array(QQN::PersonAttachment()->Name,QQN::PersonAttachment()->PersonObject->Id,QQN::PersonAttachment()->FileDocumentObject->Id);
        $columnItems = array('Name','Person','FileDocument');
        $this->PersonAttachmentWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPersonAttachment = new QButton($this);
        $this->btnNewPersonAttachment->Text = 'Add PersonAttachment';
        $this->btnNewPersonAttachment->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnNewPersonAttachment_Clicked'));
        $this->PersonAttachmentGrid = new PersonAttachmentDataGrid($this, QQN::PersonAttachment(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PersonAttachmentWaitControlIcon, 'PersonAttachmentGrid');
    }
    protected function PersonAttachmentGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachmentGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachmentGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachmentGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachmentGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachmentGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonAttachmentId = $strParameter;
        $theObject = PersonAttachment::Load($this->selectedPersonAttachmentId);
        if ($theObject) {
            $this->PersonAttachmentInstance->setObject($theObject);
            $this->PersonAttachmentInstance->setValues($theObject);
            $this->PersonAttachmentInstance->refreshAll();
            $this->btnDeletePersonAttachment->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
        }
    }
    protected function btnNewPersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonAttachmentId = -1;
        $this->PersonAttachmentInstance->setObject(null);
        $this->PersonAttachmentInstance->setValues(null);
        $this->btnDeletePersonAttachment->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
    }
}
PersonAttachment_OverviewForm::Run('PersonAttachment_OverviewForm');
?>