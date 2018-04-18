<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmploymentHistory/EmploymentHistoryDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmploymentHistory_ListForm extends QForm {
    // Data list variables
    protected $EmploymentHistoryList;
    protected $btnNewEmploymentHistory;

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

        $this->InitEmploymentHistoryDataList();
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
            $this->EmploymentHistoryList->refreshList();
            AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
        }
    }
    protected function btnDeleteEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmploymentHistoryInstance->deleteObject()) {
            $this->EmploymentHistoryList->refreshList();
            AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
        }
    }
    protected function InitEmploymentHistoryDataList() {
        $searchableAttributes = array(QQN::EmploymentHistory()->PeriodStartDate,QQN::EmploymentHistory()->PeriodEndDate,QQN::EmploymentHistory()->EmployerName,QQN::EmploymentHistory()->Title,QQN::EmploymentHistory()->Duties,QQN::EmploymentHistory()->PersonObject->Id,QQN::EmploymentHistory()->FileDocumentObject->Id);
        $SortAttributesShown = array('Period Start Date','Period End Date','Employer Name','Title','Duties','Person Object','File Document Object');
        $SortAttributes = array(QQN::EmploymentHistory()->PeriodStartDate,QQN::EmploymentHistory()->PeriodEndDate,QQN::EmploymentHistory()->EmployerName,QQN::EmploymentHistory()->Title,QQN::EmploymentHistory()->Duties,QQN::EmploymentHistory()->PersonObject->Id,QQN::EmploymentHistory()->FileDocumentObject->Id);
        $columnItems = array('PeriodStartDate','PeriodEndDate','EmployerName','Title','Duties','Person','FileDocument');
        $this->btnNewEmploymentHistory = AppSpecificFunctions::getNewActionButton($this,'Add EmploymentHistory','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewEmploymentHistory_Clicked');
        $this->EmploymentHistoryList = new EmploymentHistoryDataList($this, QQN::EmploymentHistory(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function EmploymentHistory_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmploymentHistoryList->getActiveId() != $strParameter)
                $this->EmploymentHistoryList->setActiveId($strParameter);
            else
                $this->EmploymentHistoryList->setActiveId(null);
        $theObject = EmploymentHistory::Load($strParameter);
        if ($theObject) {
            $this->EmploymentHistoryInstance->setObject($theObject);
            $this->EmploymentHistoryInstance->setValues($theObject);
            $this->EmploymentHistoryInstance->refreshAll();
            $this->btnDeleteEmploymentHistory->Visible = true;
            AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
        }
    }
    protected function EmploymentHistory_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistory_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistory_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistory_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmploymentHistory_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmploymentHistoryList->setActiveId(null);
        $this->EmploymentHistoryInstance->setObject(null);
        $this->EmploymentHistoryInstance->setValues(null);
        $this->btnDeleteEmploymentHistory->Visible = false;
        AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
    }
}
EmploymentHistory_ListForm::Run('EmploymentHistory_ListForm');
?>