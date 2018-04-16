<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/RemoteAccess/RemoteAccessController.php');
require(__SDEV_CONTROLS__.'/Implementations/RemoteAccess/RemoteAccessDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class RemoteAccess_OverviewForm extends QForm {
    // Data grid variables
    protected $RemoteAccessGrid;
    protected $RemoteAccessWaitControlIcon;
    protected $btnNewRemoteAccess;
    protected $selectedRemoteAccessId = -1;

    // RemoteAccess Object variables
    protected $RemoteAccessInstance;
    protected $btnSaveRemoteAccess,$btnDeleteRemoteAccess;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitRemoteAccessDataGrid();
        $this->InitRemoteAccessModal();
    }
    protected function InitRemoteAccessModal() {
        $this->RemoteAccessInstance = new RemoteAccessController($this);

        $this->btnSaveRemoteAccess = new QButton($this);
        $this->btnSaveRemoteAccess->Text = 'Save';
        $this->btnSaveRemoteAccess->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnSaveRemoteAccess_Clicked'));

        $this->btnDeleteRemoteAccess = new QButton($this);
        $this->btnDeleteRemoteAccess->Text = 'Delete';
        $this->btnDeleteRemoteAccess->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteRemoteAccess->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteRemoteAccess_Clicked'));
    }
    protected function btnSaveRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->RemoteAccessInstance->saveObject()) {
            $this->RemoteAccessGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('RemoteAccessModal');
        }
    }
    protected function btnDeleteRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->RemoteAccessInstance->deleteObject()) {
            $this->RemoteAccessGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('RemoteAccessModal');
        }
    }
    protected function InitRemoteAccessDataGrid() {
        $searchableAttributes = array(QQN::RemoteAccess()->IpAddress,QQN::RemoteAccess()->AccessDateTime);
        $headerItems = array('Ip Address','Access Date Time');
        $headerSortNodes = array(QQN::RemoteAccess()->IpAddress,QQN::RemoteAccess()->AccessDateTime);
        $columnItems = array('IpAddress','AccessDateTime');
        $this->RemoteAccessWaitControlIcon = new QWaitIcon($this);
        $this->btnNewRemoteAccess = new QButton($this);
        $this->btnNewRemoteAccess->Text = 'Add RemoteAccess';
        $this->btnNewRemoteAccess->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnNewRemoteAccess_Clicked'));
        $this->RemoteAccessGrid = new RemoteAccessDataGrid($this, QQN::RemoteAccess(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->RemoteAccessWaitControlIcon, 'RemoteAccessGrid');
    }
    protected function RemoteAccessGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccessGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccessGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccessGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccessGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccessGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedRemoteAccessId = $strParameter;
        $theObject = RemoteAccess::Load($this->selectedRemoteAccessId);
        if ($theObject) {
            $this->RemoteAccessInstance->setObject($theObject);
            $this->RemoteAccessInstance->setValues($theObject);
            $this->RemoteAccessInstance->refreshAll();
            $this->btnDeleteRemoteAccess->Visible = true;
            AppSpecificFunctions::ToggleModal('RemoteAccessModal');
        }
    }
    protected function btnNewRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedRemoteAccessId = -1;
        $this->RemoteAccessInstance->setObject(null);
        $this->RemoteAccessInstance->setValues(null);
        $this->btnDeleteRemoteAccess->Visible = false;
        AppSpecificFunctions::ToggleModal('RemoteAccessModal');
    }
}
RemoteAccess_OverviewForm::Run('RemoteAccess_OverviewForm');
?>