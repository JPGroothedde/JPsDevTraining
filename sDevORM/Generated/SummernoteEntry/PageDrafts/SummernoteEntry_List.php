<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/SummernoteEntry/SummernoteEntryController.php');
require(__SDEV_CONTROLS__.'/Implementations/SummernoteEntry/SummernoteEntryDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class SummernoteEntry_ListForm extends QForm {
    // Data list variables
    protected $SummernoteEntryList;
    protected $btnNewSummernoteEntry;

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

        $this->InitSummernoteEntryDataList();
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
            $this->SummernoteEntryList->refreshList();
            AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
        }
    }
    protected function btnDeleteSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryInstance->deleteObject()) {
            $this->SummernoteEntryList->refreshList();
            AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
        }
    }
    protected function InitSummernoteEntryDataList() {
        $searchableAttributes = array(QQN::SummernoteEntry()->EntryHtml,QQN::SummernoteEntry()->AuthorId,QQN::SummernoteEntry()->LastChangedDate);
        $SortAttributesShown = array('Entry Html','Author Id','Last Changed Date');
        $SortAttributes = array(QQN::SummernoteEntry()->EntryHtml,QQN::SummernoteEntry()->AuthorId,QQN::SummernoteEntry()->LastChangedDate);
        $columnItems = array('EntryHtml','AuthorId','LastChangedDate');
        $this->btnNewSummernoteEntry = AppSpecificFunctions::getNewActionButton($this,'Add SummernoteEntry','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewSummernoteEntry_Clicked');
        $this->SummernoteEntryList = new SummernoteEntryDataList($this, QQN::SummernoteEntry(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function SummernoteEntry_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryList->getActiveId() != $strParameter)
                $this->SummernoteEntryList->setActiveId($strParameter);
            else
                $this->SummernoteEntryList->setActiveId(null);
        $theObject = SummernoteEntry::Load($strParameter);
        if ($theObject) {
            $this->SummernoteEntryInstance->setObject($theObject);
            $this->SummernoteEntryInstance->setValues($theObject);
            $this->SummernoteEntryInstance->refreshAll();
            $this->btnDeleteSummernoteEntry->Visible = true;
            AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
        }
    }
    protected function SummernoteEntry_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntry_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntry_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntry_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SummernoteEntry_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SummernoteEntryList->setActiveId(null);
        $this->SummernoteEntryInstance->setObject(null);
        $this->SummernoteEntryInstance->setValues(null);
        $this->btnDeleteSummernoteEntry->Visible = false;
        AppSpecificFunctions::ToggleModal('SummernoteEntryModal');
    }
}
SummernoteEntry_ListForm::Run('SummernoteEntry_ListForm');
?>