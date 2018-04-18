<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/AuditLogEntry/AuditLogEntryController.php');
require(__SDEV_CONTROLS__.'/Implementations/AuditLogEntry/AuditLogEntryDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class AuditLogEntry_OverviewForm extends QForm {
    // Data grid variables
    protected $AuditLogEntryGrid;
    protected $AuditLogEntryWaitControlIcon;
    protected $btnNewAuditLogEntry;
    protected $selectedAuditLogEntryId = -1;

    // AuditLogEntry Object variables
    protected $AuditLogEntryInstance;
    protected $btnSaveAuditLogEntry,$btnDeleteAuditLogEntry;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitAuditLogEntryDataGrid();
        $this->InitAuditLogEntryModal();
    }
    protected function InitAuditLogEntryModal() {
        $this->AuditLogEntryInstance = new AuditLogEntryController($this);

        $this->btnSaveAuditLogEntry = new QButton($this);
        $this->btnSaveAuditLogEntry->Text = 'Save';
        $this->btnSaveAuditLogEntry->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAuditLogEntry_Clicked'));

        $this->btnDeleteAuditLogEntry = new QButton($this);
        $this->btnDeleteAuditLogEntry->Text = 'Delete';
        $this->btnDeleteAuditLogEntry->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteAuditLogEntry->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAuditLogEntry_Clicked'));
    }
    protected function btnSaveAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryInstance->saveObject()) {
            $this->AuditLogEntryGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
        }
    }
    protected function btnDeleteAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryInstance->deleteObject()) {
            $this->AuditLogEntryGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
        }
    }
    protected function InitAuditLogEntryDataGrid() {
        $searchableAttributes = array(QQN::AuditLogEntry()->EntryTimeStamp,QQN::AuditLogEntry()->ObjectName,QQN::AuditLogEntry()->ModificationType,QQN::AuditLogEntry()->UserEmail,QQN::AuditLogEntry()->ObjectId,QQN::AuditLogEntry()->AuditLogEntryDetail);
        $headerItems = array('Entry Time Stamp','Object Name','Modification Type','User Email','Object Id','Audit Log Entry Detail');
        $headerSortNodes = array(QQN::AuditLogEntry()->EntryTimeStamp,QQN::AuditLogEntry()->ObjectName,QQN::AuditLogEntry()->ModificationType,QQN::AuditLogEntry()->UserEmail,QQN::AuditLogEntry()->ObjectId,QQN::AuditLogEntry()->AuditLogEntryDetail);
        $columnItems = array('EntryTimeStamp','ObjectName','ModificationType','UserEmail','ObjectId','AuditLogEntryDetail');
        $this->AuditLogEntryWaitControlIcon = new QWaitIcon($this);
        $this->btnNewAuditLogEntry = new QButton($this);
        $this->btnNewAuditLogEntry->Text = 'Add AuditLogEntry';
        $this->btnNewAuditLogEntry->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnNewAuditLogEntry_Clicked'));
        $this->AuditLogEntryGrid = new AuditLogEntryDataGrid($this, QQN::AuditLogEntry(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->AuditLogEntryWaitControlIcon, 'AuditLogEntryGrid');
    }
    protected function AuditLogEntryGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntryGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntryGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntryGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntryGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntryGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedAuditLogEntryId = $strParameter;
        $theObject = AuditLogEntry::Load($this->selectedAuditLogEntryId);
        if ($theObject) {
            $this->AuditLogEntryInstance->setObject($theObject);
            $this->AuditLogEntryInstance->setValues($theObject);
            $this->AuditLogEntryInstance->refreshAll();
            $this->btnDeleteAuditLogEntry->Visible = true;
            AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
        }
    }
    protected function btnNewAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedAuditLogEntryId = -1;
        $this->AuditLogEntryInstance->setObject(null);
        $this->AuditLogEntryInstance->setValues(null);
        $this->btnDeleteAuditLogEntry->Visible = false;
        AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
    }
}
AuditLogEntry_OverviewForm::Run('AuditLogEntry_OverviewForm');
?>