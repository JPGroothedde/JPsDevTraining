<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/SummernoteEntry/SummernoteEntryController.php');
require(__SDEV_CONTROLS__.'/Implementations/SummernoteEntry/SummernoteEntryDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class SummernoteEntry_OverviewForm extends QForm {
    // Data grid variables
    protected $SummernoteEntryGrid;
    protected $SummernoteEntryWaitControlIcon;
    protected $btnNewSummernoteEntry;
    protected $selectedSummernoteEntryId = -1;

    // SummernoteEntry Object variables
    protected $SummernoteEntryInstance;
    protected $btnSaveSummernoteEntry,$btnDeleteSummernoteEntry;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitSummernoteEntryDataGrid();
        $this->InitSummernoteEntryModal();
    }
    protected function InitSummernoteEntryModal() {
        $this->SummernoteEntryInstance = new SummernoteEntryController($this);

        $this->btnSaveSummernoteEntry = new QButton($this);
        $this->btnSaveSummernoteEntry->Text = 'Save';
        $this->btnSaveSummernoteEntry->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnSaveSummernoteEntry_Clicked'));

        $this->btnDeleteSummernoteEntry = new QButton($this);
        $this->btnDeleteSummernoteEntry->Text = 'Delete';
        $this->btnDeleteSummernoteEntry->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteSummernoteEntry->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteSummernoteEntry_Clicked'));
    }
    protected function btnSaveSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryInstance->saveObject()) {
            $this->SummernoteEntryGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
        }
    }
    protected function btnDeleteSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryInstance->deleteObject()) {
            $this->SummernoteEntryGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
        }
    }
    protected function InitSummernoteEntryDataGrid() {
        $searchableAttributes = array(QQN::SummernoteEntry()->EntryHtml,QQN::SummernoteEntry()->AuthorId,QQN::SummernoteEntry()->LastChangedDate);
        $headerItems = array('Entry Html','Author Id','Last Changed Date');
        $headerSortNodes = array(QQN::SummernoteEntry()->EntryHtml,QQN::SummernoteEntry()->AuthorId,QQN::SummernoteEntry()->LastChangedDate);
        $columnItems = array('EntryHtml','AuthorId','LastChangedDate');
        $this->SummernoteEntryWaitControlIcon = new QWaitIcon($this);
        $this->btnNewSummernoteEntry = new QButton($this);
        $this->btnNewSummernoteEntry->Text = 'Add SummernoteEntry';
        $this->btnNewSummernoteEntry->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnNewSummernoteEntry_Clicked'));
        $this->SummernoteEntryGrid = new SummernoteEntryDataGrid($this, QQN::SummernoteEntry(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->SummernoteEntryWaitControlIcon, 'SummernoteEntryGrid');
    }
    protected function SummernoteEntryGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntryGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntryGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntryGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntryGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntryGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedSummernoteEntryId = $strParameter;
        $theObject = SummernoteEntry::Load($this->selectedSummernoteEntryId);
        if ($theObject) {
            $this->SummernoteEntryInstance->setObject($theObject);
            $this->SummernoteEntryInstance->setValues($theObject);
            $this->SummernoteEntryInstance->refreshAll();
            $this->btnDeleteSummernoteEntry->Visible = true;
            AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
        }
    }
    protected function btnNewSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedSummernoteEntryId = -1;
        $this->SummernoteEntryInstance->setObject(null);
        $this->SummernoteEntryInstance->setValues(null);
        $this->btnDeleteSummernoteEntry->Visible = false;
        AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
    }
}
SummernoteEntry_OverviewForm::Run('SummernoteEntry_OverviewForm');
?>