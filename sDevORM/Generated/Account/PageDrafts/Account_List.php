<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Account/AccountController.php');
require(__SDEV_CONTROLS__.'/Implementations/Account/AccountDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Account_ListForm extends QForm {
    // Data list variables
    protected $AccountList;
    protected $btnNewAccount;

    // Account Object variables
    protected $AccountInstance;
    protected $btnSaveAccount,$btnDeleteAccount;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitAccountDataList();
        $this->InitAccountModal();
    }
    protected function InitAccountModal() {
        $this->AccountInstance = new AccountController($this);

        $this->btnSaveAccount = new QButton($this);
        $this->btnSaveAccount->Text = 'Save';
        $this->btnSaveAccount->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveAccount->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAccount_Clicked'));

        $this->btnDeleteAccount = new QButton($this);
        $this->btnDeleteAccount->Text = 'Delete';
        $this->btnDeleteAccount->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteAccount->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAccount->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAccount_Clicked'));
    }
    protected function btnSaveAccount_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AccountInstance->saveObject()) {
            $this->AccountList->refreshList();
            AppSpecificFunctions::ToggleModal('AccountModal');
        }
    }
    protected function btnDeleteAccount_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AccountInstance->deleteObject()) {
            $this->AccountList->refreshList();
            AppSpecificFunctions::ToggleModal('AccountModal');
        }
    }
    protected function InitAccountDataList() {
        $searchableAttributes = array(QQN::Account()->FullName,QQN::Account()->FirstName,QQN::Account()->LastName,QQN::Account()->EmailAddress,QQN::Account()->Username,QQN::Account()->Password,QQN::Account()->ChangedBy,QQN::Account()->UserRoleObject->Id);
        $SortAttributesShown = array('Full Name','First Name','Last Name','Email Address','Username','Password','Changed By','User Role Object');
        $SortAttributes = array(QQN::Account()->FullName,QQN::Account()->FirstName,QQN::Account()->LastName,QQN::Account()->EmailAddress,QQN::Account()->Username,QQN::Account()->Password,QQN::Account()->ChangedBy,QQN::Account()->UserRoleObject->Id);
        $columnItems = array('FullName','FirstName','LastName','EmailAddress','Username','Password','ChangedBy','UserRole');
        $this->btnNewAccount = AppSpecificFunctions::getNewActionButton($this,'Add Account','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewAccount_Clicked');
        $this->AccountList = new AccountDataList($this, QQN::Account(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Account_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->AccountList->getActiveId() != $strParameter)
                $this->AccountList->setActiveId($strParameter);
            else
                $this->AccountList->setActiveId(null);
        $theObject = Account::Load($strParameter);
        if ($theObject) {
            $this->AccountInstance->setObject($theObject);
            $this->AccountInstance->setValues($theObject);
            $this->AccountInstance->refreshAll();
            $this->btnDeleteAccount->Visible = true;
            AppSpecificFunctions::ToggleModal('AccountModal');
        }
    }
    protected function Account_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->AccountList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Account_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->AccountList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Account_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->AccountList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Account_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->AccountList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Account_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->AccountList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewAccount_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AccountList->setActiveId(null);
        $this->AccountInstance->setObject(null);
        $this->AccountInstance->setValues(null);
        $this->btnDeleteAccount->Visible = false;
        AppSpecificFunctions::ToggleModal('AccountModal');
    }
}
Account_ListForm::Run('Account_ListForm');
?>