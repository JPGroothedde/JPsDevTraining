<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyController.php');
require(__SDEV_CONTROLS__.'/Implementations/ApiKey/ApiKeyDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ApiKey_ListForm extends QForm {
    // Data list variables
    protected $ApiKeyList;
    protected $btnNewApiKey;

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

        $this->InitApiKeyDataList();
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
            $this->ApiKeyList->refreshList();
            AppSpecificFunctions::ToggleModal('ApiKeyModal');
        }
    }
    protected function btnDeleteApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiKeyInstance->deleteObject()) {
            $this->ApiKeyList->refreshList();
            AppSpecificFunctions::ToggleModal('ApiKeyModal');
        }
    }
    protected function InitApiKeyDataList() {
        $searchableAttributes = array(QQN::ApiKey()->ApiKey,QQN::ApiKey()->Status);
        $SortAttributesShown = array('Api Key','Status');
        $SortAttributes = array(QQN::ApiKey()->ApiKey,QQN::ApiKey()->Status);
        $columnItems = array('ApiKey','Status');
        $this->btnNewApiKey = AppSpecificFunctions::getNewActionButton($this,'Add ApiKey','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewApiKey_Clicked');
        $this->ApiKeyList = new ApiKeyDataList($this, QQN::ApiKey(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function ApiKey_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiKeyList->getActiveId() != $strParameter)
                $this->ApiKeyList->setActiveId($strParameter);
            else
                $this->ApiKeyList->setActiveId(null);
        $theObject = ApiKey::Load($strParameter);
        if ($theObject) {
            $this->ApiKeyInstance->setObject($theObject);
            $this->ApiKeyInstance->setValues($theObject);
            $this->ApiKeyInstance->refreshAll();
            $this->btnDeleteApiKey->Visible = true;
            AppSpecificFunctions::ToggleModal('ApiKeyModal');
        }
    }
    protected function ApiKey_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKey_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKey_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKey_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiKey_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiKeyList->setActiveId(null);
        $this->ApiKeyInstance->setObject(null);
        $this->ApiKeyInstance->setValues(null);
        $this->btnDeleteApiKey->Visible = false;
        AppSpecificFunctions::ToggleModal('ApiKeyModal');
    }
}
ApiKey_ListForm::Run('ApiKey_ListForm');
?>