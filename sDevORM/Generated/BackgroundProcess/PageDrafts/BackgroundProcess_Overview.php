<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessController.php');
require(__SDEV_CONTROLS__.'/Implementations/BackgroundProcess/BackgroundProcessDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class BackgroundProcess_OverviewForm extends QForm {
    // Data grid variables
    protected $BackgroundProcessGrid;
    protected $BackgroundProcessWaitControlIcon;
    protected $btnNewBackgroundProcess;
    protected $selectedBackgroundProcessId = -1;

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

        $this->InitBackgroundProcessDataGrid();
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
            $this->BackgroundProcessGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
        }
    }
    protected function btnDeleteBackgroundProcess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessInstance->deleteObject()) {
            $this->BackgroundProcessGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
        }
    }
    protected function InitBackgroundProcessDataGrid() {
        $searchableAttributes = array(QQN::BackgroundProcess()->PId,QQN::BackgroundProcess()->UserId,QQN::BackgroundProcess()->UpdateDateTime,QQN::BackgroundProcess()->Status,QQN::BackgroundProcess()->Summary,QQN::BackgroundProcess()->StartDateTime);
        $headerItems = array('P Id','User Id','Update Date Time','Status','Summary','Start Date Time');
        $headerSortNodes = array(QQN::BackgroundProcess()->PId,QQN::BackgroundProcess()->UserId,QQN::BackgroundProcess()->UpdateDateTime,QQN::BackgroundProcess()->Status,QQN::BackgroundProcess()->Summary,QQN::BackgroundProcess()->StartDateTime);
        $columnItems = array('PId','UserId','UpdateDateTime','Status','Summary','StartDateTime');
        $this->BackgroundProcessWaitControlIcon = new QWaitIcon($this);
        $this->btnNewBackgroundProcess = new QButton($this);
        $this->btnNewBackgroundProcess->Text = 'Add BackgroundProcess';
        $this->btnNewBackgroundProcess->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewBackgroundProcess->AddAction(new QClickEvent(), new QAjaxAction('btnNewBackgroundProcess_Clicked'));
        $this->BackgroundProcessGrid = new BackgroundProcessDataGrid($this, QQN::BackgroundProcess(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->BackgroundProcessWaitControlIcon, 'BackgroundProcessGrid');
    }
    protected function BackgroundProcessGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedBackgroundProcessId = $strParameter;
        $theObject = BackgroundProcess::Load($this->selectedBackgroundProcessId);
        if ($theObject) {
            $this->BackgroundProcessInstance->setObject($theObject);
            $this->BackgroundProcessInstance->setValues($theObject);
            $this->BackgroundProcessInstance->refreshAll();
            $this->btnDeleteBackgroundProcess->Visible = true;
            AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
        }
    }
    protected function btnNewBackgroundProcess_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedBackgroundProcessId = -1;
        $this->BackgroundProcessInstance->setObject(null);
        $this->BackgroundProcessInstance->setValues(null);
        $this->btnDeleteBackgroundProcess->Visible = false;
        AppSpecificFunctions::ToggleModal('BackgroundProcessModal');
    }
}
BackgroundProcess_OverviewForm::Run('BackgroundProcess_OverviewForm');
?>