<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Reference/ReferenceController.php');
require(__SDEV_CONTROLS__.'/Implementations/Reference/ReferenceDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Reference_OverviewForm extends QForm {
    // Data grid variables
    protected $ReferenceGrid;
    protected $ReferenceWaitControlIcon;
    protected $btnNewReference;
    protected $selectedReferenceId = -1;

    // Reference Object variables
    protected $ReferenceInstance;
    protected $btnSaveReference,$btnDeleteReference;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitReferenceDataGrid();
        $this->InitReferenceModal();
    }
    protected function InitReferenceModal() {
        $this->ReferenceInstance = new ReferenceController($this);

        $this->btnSaveReference = new QButton($this);
        $this->btnSaveReference->Text = 'Save';
        $this->btnSaveReference->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveReference->AddAction(new QClickEvent(), new QAjaxAction('btnSaveReference_Clicked'));

        $this->btnDeleteReference = new QButton($this);
        $this->btnDeleteReference->Text = 'Delete';
        $this->btnDeleteReference->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteReference->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteReference->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteReference_Clicked'));
    }
    protected function btnSaveReference_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ReferenceInstance->saveObject()) {
            $this->ReferenceGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ReferenceModal');
        }
    }
    protected function btnDeleteReference_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ReferenceInstance->deleteObject()) {
            $this->ReferenceGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ReferenceModal');
        }
    }
    protected function InitReferenceDataGrid() {
        $searchableAttributes = array(QQN::Reference()->FirstName,QQN::Reference()->Surname,QQN::Reference()->Relationship,QQN::Reference()->TelephoneNumber,QQN::Reference()->PersonObject->Id,QQN::Reference()->FileDocumentObject->Id);
        $headerItems = array('First Name','Surname','Relationship','Telephone Number','Person Object','File Document Object');
        $headerSortNodes = array(QQN::Reference()->FirstName,QQN::Reference()->Surname,QQN::Reference()->Relationship,QQN::Reference()->TelephoneNumber,QQN::Reference()->PersonObject->Id,QQN::Reference()->FileDocumentObject->Id);
        $columnItems = array('FirstName','Surname','Relationship','TelephoneNumber','Person','FileDocument');
        $this->ReferenceWaitControlIcon = new QWaitIcon($this);
        $this->btnNewReference = new QButton($this);
        $this->btnNewReference->Text = 'Add Reference';
        $this->btnNewReference->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewReference->AddAction(new QClickEvent(), new QAjaxAction('btnNewReference_Clicked'));
        $this->ReferenceGrid = new ReferenceDataGrid($this, QQN::Reference(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->ReferenceWaitControlIcon, 'ReferenceGrid');
    }
    protected function ReferenceGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ReferenceGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ReferenceGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ReferenceGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ReferenceGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ReferenceGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ReferenceGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ReferenceGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ReferenceGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->ReferenceGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ReferenceGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedReferenceId = $strParameter;
        $theObject = Reference::Load($this->selectedReferenceId);
        if ($theObject) {
            $this->ReferenceInstance->setObject($theObject);
            $this->ReferenceInstance->setValues($theObject);
            $this->ReferenceInstance->refreshAll();
            $this->btnDeleteReference->Visible = true;
            AppSpecificFunctions::ToggleModal('ReferenceModal');
        }
    }
    protected function btnNewReference_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedReferenceId = -1;
        $this->ReferenceInstance->setObject(null);
        $this->ReferenceInstance->setValues(null);
        $this->btnDeleteReference->Visible = false;
        AppSpecificFunctions::ToggleModal('ReferenceModal');
    }
}
Reference_OverviewForm::Run('Reference_OverviewForm');
?>