<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/LoginToken/LoginTokenController.php');
require(__SDEV_CONTROLS__.'/Implementations/LoginToken/LoginTokenDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class LoginToken_ListForm extends QForm {
    // Data list variables
    protected $LoginTokenList;
    protected $btnNewLoginToken;

    // LoginToken Object variables
    protected $LoginTokenInstance;
    protected $btnSaveLoginToken,$btnDeleteLoginToken;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitLoginTokenDataList();
        $this->InitLoginTokenModal();
    }
    protected function InitLoginTokenModal() {
        $this->LoginTokenInstance = new LoginTokenController($this);

        $this->btnSaveLoginToken = new QButton($this);
        $this->btnSaveLoginToken->Text = 'Save';
        $this->btnSaveLoginToken->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveLoginToken->AddAction(new QClickEvent(), new QAjaxAction('btnSaveLoginToken_Clicked'));

        $this->btnDeleteLoginToken = new QButton($this);
        $this->btnDeleteLoginToken->Text = 'Delete';
        $this->btnDeleteLoginToken->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteLoginToken->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteLoginToken->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteLoginToken_Clicked'));
    }
    protected function btnSaveLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LoginTokenInstance->saveObject()) {
            $this->LoginTokenList->refreshList();
            AppSpecificFunctions::ToggleModal('LoginTokenModal');
        }
    }
    protected function btnDeleteLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LoginTokenInstance->deleteObject()) {
            $this->LoginTokenList->refreshList();
            AppSpecificFunctions::ToggleModal('LoginTokenModal');
        }
    }
    protected function InitLoginTokenDataList() {
        $searchableAttributes = array(QQN::LoginToken()->LoginToken,QQN::LoginToken()->AccountObject->Id);
        $SortAttributesShown = array('Login Token','Account Object');
        $SortAttributes = array(QQN::LoginToken()->LoginToken,QQN::LoginToken()->AccountObject->Id);
        $columnItems = array('LoginToken','Account');
        $this->btnNewLoginToken = AppSpecificFunctions::getNewActionButton($this,'Add LoginToken','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewLoginToken_Clicked');
        $this->LoginTokenList = new LoginTokenDataList($this, QQN::LoginToken(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function LoginToken_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->LoginTokenList->getActiveId() != $strParameter)
                $this->LoginTokenList->setActiveId($strParameter);
            else
                $this->LoginTokenList->setActiveId(null);
        $theObject = LoginToken::Load($strParameter);
        if ($theObject) {
            $this->LoginTokenInstance->setObject($theObject);
            $this->LoginTokenInstance->setValues($theObject);
            $this->LoginTokenInstance->refreshAll();
            $this->btnDeleteLoginToken->Visible = true;
            AppSpecificFunctions::ToggleModal('LoginTokenModal');
        }
    }
    protected function LoginToken_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function LoginToken_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function LoginToken_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function LoginToken_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LoginToken_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenList->setActiveId(null);
        $this->LoginTokenInstance->setObject(null);
        $this->LoginTokenInstance->setValues(null);
        $this->btnDeleteLoginToken->Visible = false;
        AppSpecificFunctions::ToggleModal('LoginTokenModal');
    }
}
LoginToken_ListForm::Run('LoginToken_ListForm');
?>