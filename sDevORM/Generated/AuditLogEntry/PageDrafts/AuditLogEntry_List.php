<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/AuditLogEntry/AuditLogEntryController.php');
require(__SDEV_CONTROLS__.'/Implementations/AuditLogEntry/AuditLogEntryDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class AuditLogEntry_ListForm extends QForm {
    // Data list variables
    protected $AuditLogEntryList;
    protected $btnNewAuditLogEntry;

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

        $this->InitAuditLogEntryDataList();
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
            $this->AuditLogEntryList->refreshList();
            AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
        }
    }
    protected function btnDeleteAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryInstance->deleteObject()) {
            $this->AuditLogEntryList->refreshList();
            AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
        }
    }
    protected function InitAuditLogEntryDataList() {
        $searchableAttributes = array(QQN::AuditLogEntry()->EntryTimeStamp,QQN::AuditLogEntry()->ObjectName,QQN::AuditLogEntry()->ModificationType,QQN::AuditLogEntry()->UserEmail,QQN::AuditLogEntry()->ObjectId,QQN::AuditLogEntry()->AuditLogEntryDetail);
        $SortAttributesShown = array('Entry Time Stamp','Object Name','Modification Type','User Email','Object Id','Audit Log Entry Detail');
        $SortAttributes = array(QQN::AuditLogEntry()->EntryTimeStamp,QQN::AuditLogEntry()->ObjectName,QQN::AuditLogEntry()->ModificationType,QQN::AuditLogEntry()->UserEmail,QQN::AuditLogEntry()->ObjectId,QQN::AuditLogEntry()->AuditLogEntryDetail);
        $columnItems = array('EntryTimeStamp','ObjectName','ModificationType','UserEmail','ObjectId','AuditLogEntryDetail');
        $this->btnNewAuditLogEntry = AppSpecificFunctions::getNewActionButton($this,'Add AuditLogEntry','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewAuditLogEntry_Clicked');
        $this->AuditLogEntryList = new AuditLogEntryDataList($this, QQN::AuditLogEntry(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function AuditLogEntry_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryList->getActiveId() != $strParameter)
                $this->AuditLogEntryList->setActiveId($strParameter);
            else
                $this->AuditLogEntryList->setActiveId(null);
        $theObject = AuditLogEntry::Load($strParameter);
        if ($theObject) {
            $this->AuditLogEntryInstance->setObject($theObject);
            $this->AuditLogEntryInstance->setValues($theObject);
            $this->AuditLogEntryInstance->refreshAll();
            $this->btnDeleteAuditLogEntry->Visible = true;
            AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
        }
    }
    protected function AuditLogEntry_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntry_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntry_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntry_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AuditLogEntry_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AuditLogEntryList->setActiveId(null);
        $this->AuditLogEntryInstance->setObject(null);
        $this->AuditLogEntryInstance->setValues(null);
        $this->btnDeleteAuditLogEntry->Visible = false;
        AppSpecificFunctions::ToggleModal('AuditLogEntryModal');
    }
}
AuditLogEntry_ListForm::Run('AuditLogEntry_ListForm');
?>