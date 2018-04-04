<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessController.php');
require(__SDEV_CONTROLS__.'/Implementations/BackgroundProcess/BackgroundProcessDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class BackgroundProcess_ListForm extends QForm {
    // Data list variables
    protected $BackgroundProcessList;
    protected $btnNewBackgroundProcess;

    // BackgroundProcess Object variables
    protected $BackgroundProcessInstance;
    protected $btnSaveBackgroundProcess,$btnDeleteBackgroundProcess;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitBackgroundProcessDataList();
        $this->InitBackgroundProcessModal();
    }
    protected function InitBackgroundProcessModal() {
        $this->BackgroundProcessInstance = new BackgroundProcessController($this);

        $this->btnSaveBackgroundProcess = new QButton($this);
        $this->btnSaveBackgroundProcess->Text = 'Save';
        $this->btnSaveBackgroundProcess->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveBackgroundProcess->AddAction(new QClickEvent(), new QAjaxAction('btnSaveBackgroundProcess_Clicked'));

        $this->btnDeleteBackgroundProcess = new QButton($this);
        $this->btnDeleteBackgroundProcess->Text = 'Delete';
        $this->btnDeleteBackgroundProcess->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteBackgroundProcess->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteBackgroundProcess->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteBackgroundProcess_Clicked'));
    }
    protected function btnSaveBackgroundProcess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessInstance->saveObject()) {
            $this->BackgroundProcessList->refreshList();
            AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
        }
    }
    protected function btnDeleteBackgroundProcess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessInstance->deleteObject()) {
            $this->BackgroundProcessList->refreshList();
            AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
        }
    }
    protected function InitBackgroundProcessDataList() {
        $searchableAttributes = array(QQN::BackgroundProcess()->PId,QQN::BackgroundProcess()->UserId,QQN::BackgroundProcess()->UpdateDateTime,QQN::BackgroundProcess()->Status,QQN::BackgroundProcess()->Summary,QQN::BackgroundProcess()->StartDateTime);
        $SortAttributesShown = array('P Id','User Id','Update Date Time','Status','Summary','Start Date Time');
        $SortAttributes = array(QQN::BackgroundProcess()->PId,QQN::BackgroundProcess()->UserId,QQN::BackgroundProcess()->UpdateDateTime,QQN::BackgroundProcess()->Status,QQN::BackgroundProcess()->Summary,QQN::BackgroundProcess()->StartDateTime);
        $columnItems = array('PId','UserId','UpdateDateTime','Status','Summary','StartDateTime');
        $this->btnNewBackgroundProcess = AppSpecificFunctions::getNewActionButton($this,'Add BackgroundProcess','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewBackgroundProcess_Clicked');
        $this->BackgroundProcessList = new BackgroundProcessDataList($this, QQN::BackgroundProcess(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function BackgroundProcess_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessList->getActiveId() != $strParameter)
                $this->BackgroundProcessList->setActiveId($strParameter);
            else
                $this->BackgroundProcessList->setActiveId(null);
        $theObject = BackgroundProcess::Load($strParameter);
        if ($theObject) {
            $this->BackgroundProcessInstance->setObject($theObject);
            $this->BackgroundProcessInstance->setValues($theObject);
            $this->BackgroundProcessInstance->refreshAll();
            $this->btnDeleteBackgroundProcess->Visible = true;
            AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
        }
    }
    protected function BackgroundProcess_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcess_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcess_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcess_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcess_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewBackgroundProcess_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessList->setActiveId(null);
        $this->BackgroundProcessInstance->setObject(null);
        $this->BackgroundProcessInstance->setValues(null);
        $this->btnDeleteBackgroundProcess->Visible = false;
        AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
    }
}
BackgroundProcess_ListForm::Run('BackgroundProcess_ListForm');
?>