<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateController.php');
require(__SDEV_CONTROLS__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class BackgroundProcessUpdate_OverviewForm extends QForm {
    // Data grid variables
    protected $BackgroundProcessUpdateGrid;
    protected $BackgroundProcessUpdateWaitControlIcon;
    protected $btnNewBackgroundProcessUpdate;
    protected $selectedBackgroundProcessUpdateId = -1;

    // BackgroundProcessUpdate Object variables
    protected $BackgroundProcessUpdateInstance;
    protected $btnSaveBackgroundProcessUpdate,$btnDeleteBackgroundProcessUpdate;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitBackgroundProcessUpdateDataGrid();
        $this->InitBackgroundProcessUpdateModal();
    }
    protected function InitBackgroundProcessUpdateModal() {
        $this->BackgroundProcessUpdateInstance = new BackgroundProcessUpdateController($this);

        $this->btnSaveBackgroundProcessUpdate = new QButton($this);
        $this->btnSaveBackgroundProcessUpdate->Text = 'Save';
        $this->btnSaveBackgroundProcessUpdate->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnSaveBackgroundProcessUpdate_Clicked'));

        $this->btnDeleteBackgroundProcessUpdate = new QButton($this);
        $this->btnDeleteBackgroundProcessUpdate->Text = 'Delete';
        $this->btnDeleteBackgroundProcessUpdate->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteBackgroundProcessUpdate->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteBackgroundProcessUpdate_Clicked'));
    }
    protected function btnSaveBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessUpdateInstance->saveObject()) {
            $this->BackgroundProcessUpdateGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
        }
    }
    protected function btnDeleteBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessUpdateInstance->deleteObject()) {
            $this->BackgroundProcessUpdateGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
        }
    }
    protected function InitBackgroundProcessUpdateDataGrid() {
        $searchableAttributes = array(QQN::BackgroundProcessUpdate()->UpdateDateTime,QQN::BackgroundProcessUpdate()->UpdateMessage,QQN::BackgroundProcessUpdate()->BackgroundProcessObject->Id);
        $headerItems = array('Update Date Time','Update Message','Background Process Object');
        $headerSortNodes = array(QQN::BackgroundProcessUpdate()->UpdateDateTime,QQN::BackgroundProcessUpdate()->UpdateMessage,QQN::BackgroundProcessUpdate()->BackgroundProcessObject->Id);
        $columnItems = array('UpdateDateTime','UpdateMessage','BackgroundProcess');
        $this->BackgroundProcessUpdateWaitControlIcon = new QWaitIcon($this);
        $this->btnNewBackgroundProcessUpdate = new QButton($this);
        $this->btnNewBackgroundProcessUpdate->Text = 'Add BackgroundProcessUpdate';
        $this->btnNewBackgroundProcessUpdate->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnNewBackgroundProcessUpdate_Clicked'));
        $this->BackgroundProcessUpdateGrid = new BackgroundProcessUpdateDataGrid($this, QQN::BackgroundProcessUpdate(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->BackgroundProcessUpdateWaitControlIcon, 'BackgroundProcessUpdateGrid');
    }
    protected function BackgroundProcessUpdateGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdateGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdateGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdateGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdateGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdateGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedBackgroundProcessUpdateId = $strParameter;
        $theObject = BackgroundProcessUpdate::Load($this->selectedBackgroundProcessUpdateId);
        if ($theObject) {
            $this->BackgroundProcessUpdateInstance->setObject($theObject);
            $this->BackgroundProcessUpdateInstance->setValues($theObject);
            $this->BackgroundProcessUpdateInstance->refreshAll();
            $this->btnDeleteBackgroundProcessUpdate->Visible = true;
            AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
        }
    }
    protected function btnNewBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedBackgroundProcessUpdateId = -1;
        $this->BackgroundProcessUpdateInstance->setObject(null);
        $this->BackgroundProcessUpdateInstance->setValues(null);
        $this->btnDeleteBackgroundProcessUpdate->Visible = false;
        AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
    }
}
BackgroundProcessUpdate_OverviewForm::Run('BackgroundProcessUpdate_OverviewForm');
?>