<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Account/AccountController.php');
require(__SDEV_CONTROLS__.'/Implementations/Account/AccountDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}
// Remove this line if the file needs to be accessible remotely(production)
//AppSpecificFunctions::CheckRemoteAdmin();
class Account_OverviewForm extends QForm {
    // Data grid variables
    protected $AccountGrid;
    protected $AccountWaitControlIcon;
    protected $btnNewAccount;
    protected $selectedAccountId = -1;

    // Account Object variables
    protected $AccountInstance;
    protected $btnSaveAccount,$btnDeleteAccount;
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();
        $this->InitAccountDataGrid();
        $this->InitAccountModal();
    }
    protected function InitAccountModal() {
        $this->AccountInstance = new AccountController($this);

        $this->btnSaveAccount = new QButton($this);
        $this->btnSaveAccount->Text = 'Save Account';
        $this->btnSaveAccount->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAccount_Clicked'));

        $this->btnDeleteAccount = new QButton($this);
        $this->btnDeleteAccount->Text = 'Delete Account';
        $this->btnDeleteAccount->CssClass = 'btn btn-danger';
        $this->btnDeleteAccount->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAccount->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAccount_Clicked'));
    }
    protected function btnSaveAccount_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AccountInstance->saveObject()) {
            $this->AccountGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('AccountModal');
        }
    }
    protected function btnDeleteAccount_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AccountInstance->deleteObject()) {
            $this->AccountGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('AccountModal');
        }
    }
    protected function InitAccountDataGrid() {
        $searchableAttributes = array(QQN::Account()->FullName,QQN::Account()->EmailAddress,QQN::Account()->ChangedBy,QQN::Account()->UserRoleObject->Role);
        $headerItems = array('Full Name','Email Address','Changed By','User Role');
        $headerSortNodes = array(QQN::Account()->FullName,QQN::Account()->EmailAddress,QQN::Account()->ChangedBy,QQN::Account()->UserRoleObject->Role);
        $columnItems = array('FullName','EmailAddress','ChangedBy','UserRole');
        $this->AccountWaitControlIcon = new QWaitIcon($this);
        $this->btnNewAccount = new QButton($this);
        $this->btnNewAccount->Text = 'Add Account';
        $this->btnNewAccount->AddCssClass('pull-right mrg-topMin55');
        $this->btnNewAccount->AddAction(new QClickEvent(), new QAjaxAction('btnNewAccount_Clicked'));
        $this->AccountGrid = new AccountDataGrid($this, QQN::Account(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->AccountWaitControlIcon, 'AccountGrid');
    }
    protected function AccountGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AccountGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AccountGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AccountGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AccountGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AccountGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AccountGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AccountGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AccountGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->AccountGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function AccountGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedAccountId = $strParameter;
        $theObject = Account::Load($this->selectedAccountId);
        if ($theObject) {
            $this->AccountInstance->setObject($theObject);
            $this->AccountInstance->setValues($theObject);
            $this->AccountInstance->refreshAll();
            $this->btnDeleteAccount->Visible = true;
            AppSpecificFunctions::ToggleModal('AccountModal');
        }
    }
    protected function btnNewAccount_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedAccountId = -1;
        $this->AccountInstance->setObject(null);
        $this->AccountInstance->setValues(null);
        $this->btnDeleteAccount->Visible = false;
        AppSpecificFunctions::ToggleModal('AccountModal');
    }
}
Account_OverviewForm::Run('Account_OverviewForm');
?>