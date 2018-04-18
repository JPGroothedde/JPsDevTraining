<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmploymentHistory/EmploymentHistoryDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmploymentHistory_OverviewForm extends QForm {
    // Data grid variables
    protected $EmploymentHistoryGrid;
    protected $EmploymentHistoryWaitControlIcon;
    protected $btnNewEmploymentHistory;
    protected $selectedEmploymentHistoryId = -1;

    // EmploymentHistory Object variables
    protected $EmploymentHistoryInstance;
    protected $btnSaveEmploymentHistory,$btnDeleteEmploymentHistory;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmploymentHistoryDataGrid();
        $this->InitEmploymentHistoryModal();
    }
    protected function InitEmploymentHistoryModal() {
        $this->EmploymentHistoryInstance = new EmploymentHistoryController($this);

        $this->btnSaveEmploymentHistory = new QButton($this);
        $this->btnSaveEmploymentHistory->Text = 'Save';
        $this->btnSaveEmploymentHistory->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmploymentHistory_Clicked'));

        $this->btnDeleteEmploymentHistory = new QButton($this);
        $this->btnDeleteEmploymentHistory->Text = 'Delete';
        $this->btnDeleteEmploymentHistory->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteEmploymentHistory->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmploymentHistory_Clicked'));
    }
    protected function btnSaveEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmploymentHistoryInstance->saveObject()) {
            $this->EmploymentHistoryGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
        }
    }
    protected function btnDeleteEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmploymentHistoryInstance->deleteObject()) {
            $this->EmploymentHistoryGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
        }
    }
    protected function InitEmploymentHistoryDataGrid() {
        $searchableAttributes = array(QQN::EmploymentHistory()->PeriodStartDate,QQN::EmploymentHistory()->PeriodEndDate,QQN::EmploymentHistory()->EmployerName,QQN::EmploymentHistory()->Title,QQN::EmploymentHistory()->Duties,QQN::EmploymentHistory()->PersonObject->Id,QQN::EmploymentHistory()->FileDocumentObject->Id);
        $headerItems = array('Period Start Date','Period End Date','Employer Name','Title','Duties','Person Object','File Document Object');
        $headerSortNodes = array(QQN::EmploymentHistory()->PeriodStartDate,QQN::EmploymentHistory()->PeriodEndDate,QQN::EmploymentHistory()->EmployerName,QQN::EmploymentHistory()->Title,QQN::EmploymentHistory()->Duties,QQN::EmploymentHistory()->PersonObject->Id,QQN::EmploymentHistory()->FileDocumentObject->Id);
        $columnItems = array('PeriodStartDate','PeriodEndDate','EmployerName','Title','Duties','Person','FileDocument');
        $this->EmploymentHistoryWaitControlIcon = new QWaitIcon($this);
        $this->btnNewEmploymentHistory = new QButton($this);
        $this->btnNewEmploymentHistory->Text = 'Add EmploymentHistory';
        $this->btnNewEmploymentHistory->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnNewEmploymentHistory_Clicked'));
        $this->EmploymentHistoryGrid = new EmploymentHistoryDataGrid($this, QQN::EmploymentHistory(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->EmploymentHistoryWaitControlIcon, 'EmploymentHistoryGrid');
    }
    protected function EmploymentHistoryGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistoryGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistoryGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistoryGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistoryGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistoryGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmploymentHistoryId = $strParameter;
        $theObject = EmploymentHistory::Load($this->selectedEmploymentHistoryId);
        if ($theObject) {
            $this->EmploymentHistoryInstance->setObject($theObject);
            $this->EmploymentHistoryInstance->setValues($theObject);
            $this->EmploymentHistoryInstance->refreshAll();
            $this->btnDeleteEmploymentHistory->Visible = true;
            AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
        }
    }
    protected function btnNewEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmploymentHistoryId = -1;
        $this->EmploymentHistoryInstance->setObject(null);
        $this->EmploymentHistoryInstance->setValues(null);
        $this->btnDeleteEmploymentHistory->Visible = false;
        AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
    }
}
EmploymentHistory_OverviewForm::Run('EmploymentHistory_OverviewForm');
?>