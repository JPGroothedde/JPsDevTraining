<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyController.php');
require(__SDEV_CONTROLS__.'/Implementations/ApiKey/ApiKeyDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ApiKey_OverviewForm extends QForm {
    // Data grid variables
    protected $ApiKeyGrid;
    protected $ApiKeyWaitControlIcon;
    protected $btnNewApiKey;
    protected $selectedApiKeyId = -1;

    // ApiKey Object variables
    protected $ApiKeyInstance;
    protected $btnSaveApiKey,$btnDeleteApiKey;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitApiKeyDataGrid();
        $this->InitApiKeyModal();
    }
    protected function InitApiKeyModal() {
        $this->ApiKeyInstance = new ApiKeyController($this);

        $this->btnSaveApiKey = new QButton($this);
        $this->btnSaveApiKey->Text = 'Save';
        $this->btnSaveApiKey->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnSaveApiKey_Clicked'));

        $this->btnDeleteApiKey = new QButton($this);
        $this->btnDeleteApiKey->Text = 'Delete';
        $this->btnDeleteApiKey->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteApiKey->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteApiKey_Clicked'));
    }
    protected function btnSaveApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiKeyInstance->saveObject()) {
            $this->ApiKeyGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ApiKeyModal');
        }
    }
    protected function btnDeleteApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiKeyInstance->deleteObject()) {
            $this->ApiKeyGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ApiKeyModal');
        }
    }
    protected function InitApiKeyDataGrid() {
        $searchableAttributes = array(QQN::ApiKey()->ApiKey,QQN::ApiKey()->Status);
        $headerItems = array('Api Key','Status');
        $headerSortNodes = array(QQN::ApiKey()->ApiKey,QQN::ApiKey()->Status);
        $columnItems = array('ApiKey','Status');
        $this->ApiKeyWaitControlIcon = new QWaitIcon($this);
        $this->btnNewApiKey = new QButton($this);
        $this->btnNewApiKey->Text = 'Add ApiKey';
        $this->btnNewApiKey->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnNewApiKey_Clicked'));
        $this->ApiKeyGrid = new ApiKeyDataGrid($this, QQN::ApiKey(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->ApiKeyWaitControlIcon, 'ApiKeyGrid');
    }
    protected function ApiKeyGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKeyGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKeyGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKeyGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKeyGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKeyGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedApiKeyId = $strParameter;
        $theObject = ApiKey::Load($this->selectedApiKeyId);
        if ($theObject) {
            $this->ApiKeyInstance->setObject($theObject);
            $this->ApiKeyInstance->setValues($theObject);
            $this->ApiKeyInstance->refreshAll();
            $this->btnDeleteApiKey->Visible = true;
            AppSpecificFunctions::ToggleModal('ApiKeyModal');
        }
    }
    protected function btnNewApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedApiKeyId = -1;
        $this->ApiKeyInstance->setObject(null);
        $this->ApiKeyInstance->setValues(null);
        $this->btnDeleteApiKey->Visible = false;
        AppSpecificFunctions::ToggleModal('ApiKeyModal');
    }
}
ApiKey_OverviewForm::Run('ApiKey_OverviewForm');
?>