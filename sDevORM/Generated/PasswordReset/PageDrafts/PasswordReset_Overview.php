<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PasswordReset/PasswordResetController.php');
require(__SDEV_CONTROLS__.'/Implementations/PasswordReset/PasswordResetDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PasswordReset_OverviewForm extends QForm {
    // Data grid variables
    protected $PasswordResetGrid;
    protected $PasswordResetWaitControlIcon;
    protected $btnNewPasswordReset;
    protected $selectedPasswordResetId = -1;

    // PasswordReset Object variables
    protected $PasswordResetInstance;
    protected $btnSavePasswordReset,$btnDeletePasswordReset;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPasswordResetDataGrid();
        $this->InitPasswordResetModal();
    }
    protected function InitPasswordResetModal() {
        $this->PasswordResetInstance = new PasswordResetController($this);

        $this->btnSavePasswordReset = new QButton($this);
        $this->btnSavePasswordReset->Text = 'Save';
        $this->btnSavePasswordReset->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnSavePasswordReset_Clicked'));

        $this->btnDeletePasswordReset = new QButton($this);
        $this->btnDeletePasswordReset->Text = 'Delete';
        $this->btnDeletePasswordReset->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePasswordReset->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePasswordReset_Clicked'));
    }
    protected function btnSavePasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PasswordResetInstance->saveObject()) {
            $this->PasswordResetGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PasswordResetModal');
        }
    }
    protected function btnDeletePasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PasswordResetInstance->deleteObject()) {
            $this->PasswordResetGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PasswordResetModal');
        }
    }
    protected function InitPasswordResetDataGrid() {
        $searchableAttributes = array(QQN::PasswordReset()->Token,QQN::PasswordReset()->CreatedDateTime,QQN::PasswordReset()->AccountObject->Id);
        $headerItems = array('Token','Created Date Time','Account Object');
        $headerSortNodes = array(QQN::PasswordReset()->Token,QQN::PasswordReset()->CreatedDateTime,QQN::PasswordReset()->AccountObject->Id);
        $columnItems = array('Token','CreatedDateTime','Account');
        $this->PasswordResetWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPasswordReset = new QButton($this);
        $this->btnNewPasswordReset->Text = 'Add PasswordReset';
        $this->btnNewPasswordReset->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnNewPasswordReset_Clicked'));
        $this->PasswordResetGrid = new PasswordResetDataGrid($this, QQN::PasswordReset(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PasswordResetWaitControlIcon, 'PasswordResetGrid');
    }
    protected function PasswordResetGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordResetGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordResetGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordResetGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordResetGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordResetGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPasswordResetId = $strParameter;
        $theObject = PasswordReset::Load($this->selectedPasswordResetId);
        if ($theObject) {
            $this->PasswordResetInstance->setObject($theObject);
            $this->PasswordResetInstance->setValues($theObject);
            $this->PasswordResetInstance->refreshAll();
            $this->btnDeletePasswordReset->Visible = true;
            AppSpecificFunctions::ToggleModal('PasswordResetModal');
        }
    }
    protected function btnNewPasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPasswordResetId = -1;
        $this->PasswordResetInstance->setObject(null);
        $this->PasswordResetInstance->setValues(null);
        $this->btnDeletePasswordReset->Visible = false;
        AppSpecificFunctions::ToggleModal('PasswordResetModal');
    }
}
PasswordReset_OverviewForm::Run('PasswordReset_OverviewForm');
?>