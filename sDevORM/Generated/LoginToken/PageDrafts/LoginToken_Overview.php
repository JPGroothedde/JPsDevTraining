<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/LoginToken/LoginTokenController.php');
require(__SDEV_CONTROLS__.'/Implementations/LoginToken/LoginTokenDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class LoginToken_OverviewForm extends QForm {
    // Data grid variables
    protected $LoginTokenGrid;
    protected $LoginTokenWaitControlIcon;
    protected $btnNewLoginToken;
    protected $selectedLoginTokenId = -1;

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

        $this->InitLoginTokenDataGrid();
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
            $this->LoginTokenGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('LoginTokenModal');
        }
    }
    protected function btnDeleteLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LoginTokenInstance->deleteObject()) {
            $this->LoginTokenGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('LoginTokenModal');
        }
    }
    protected function InitLoginTokenDataGrid() {
        $searchableAttributes = array(QQN::LoginToken()->LoginToken,QQN::LoginToken()->AccountObject->Id);
        $headerItems = array('Login Token','Account Object');
        $headerSortNodes = array(QQN::LoginToken()->LoginToken,QQN::LoginToken()->AccountObject->Id);
        $columnItems = array('LoginToken','Account');
        $this->LoginTokenWaitControlIcon = new QWaitIcon($this);
        $this->btnNewLoginToken = new QButton($this);
        $this->btnNewLoginToken->Text = 'Add LoginToken';
        $this->btnNewLoginToken->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewLoginToken->AddAction(new QClickEvent(), new QAjaxAction('btnNewLoginToken_Clicked'));
        $this->LoginTokenGrid = new LoginTokenDataGrid($this, QQN::LoginToken(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->LoginTokenWaitControlIcon, 'LoginTokenGrid');
    }
    protected function LoginTokenGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LoginTokenGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LoginTokenGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LoginTokenGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LoginTokenGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->LoginTokenGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function LoginTokenGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedLoginTokenId = $strParameter;
        $theObject = LoginToken::Load($this->selectedLoginTokenId);
        if ($theObject) {
            $this->LoginTokenInstance->setObject($theObject);
            $this->LoginTokenInstance->setValues($theObject);
            $this->LoginTokenInstance->refreshAll();
            $this->btnDeleteLoginToken->Visible = true;
            AppSpecificFunctions::ToggleModal('LoginTokenModal');
        }
    }
    protected function btnNewLoginToken_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedLoginTokenId = -1;
        $this->LoginTokenInstance->setObject(null);
        $this->LoginTokenInstance->setValues(null);
        $this->btnDeleteLoginToken->Visible = false;
        AppSpecificFunctions::ToggleModal('LoginTokenModal');
    }
}
LoginToken_OverviewForm::Run('LoginToken_OverviewForm');
?>