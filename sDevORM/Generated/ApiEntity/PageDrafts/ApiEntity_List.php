<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ApiEntity/ApiEntityController.php');
require(__SDEV_CONTROLS__.'/Implementations/ApiEntity/ApiEntityDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ApiEntity_ListForm extends QForm {
    // Data list variables
    protected $ApiEntityList;
    protected $btnNewApiEntity;

    // ApiEntity Object variables
    protected $ApiEntityInstance;
    protected $btnSaveApiEntity,$btnDeleteApiEntity;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitApiEntityDataList();
        $this->InitApiEntityModal();
    }
    protected function InitApiEntityModal() {
        $this->ApiEntityInstance = new ApiEntityController($this);

        $this->btnSaveApiEntity = new QButton($this);
        $this->btnSaveApiEntity->Text = 'Save';
        $this->btnSaveApiEntity->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveApiEntity->AddAction(new QClickEvent(), new QAjaxAction('btnSaveApiEntity_Clicked'));

        $this->btnDeleteApiEntity = new QButton($this);
        $this->btnDeleteApiEntity->Text = 'Delete';
        $this->btnDeleteApiEntity->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteApiEntity->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteApiEntity->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteApiEntity_Clicked'));
    }
    protected function btnSaveApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiEntityInstance->saveObject()) {
            $this->ApiEntityList->refreshList();
            AppSpecificFunctions::ToggleModal('ApiEntityModal');
        }
    }
    protected function btnDeleteApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiEntityInstance->deleteObject()) {
            $this->ApiEntityList->refreshList();
            AppSpecificFunctions::ToggleModal('ApiEntityModal');
        }
    }
    protected function InitApiEntityDataList() {
        $searchableAttributes = array(QQN::ApiEntity()->EntityName,QQN::ApiEntity()->ApiKeyObject->Id);
        $SortAttributesShown = array('Entity Name','Api Key Object');
        $SortAttributes = array(QQN::ApiEntity()->EntityName,QQN::ApiEntity()->ApiKeyObject->Id);
        $columnItems = array('EntityName','ApiKey');
        $this->btnNewApiEntity = AppSpecificFunctions::getNewActionButton($this,'Add ApiEntity','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewApiEntity_Clicked');
        $this->ApiEntityList = new ApiEntityDataList($this, QQN::ApiEntity(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function ApiEntity_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiEntityList->getActiveId() != $strParameter)
                $this->ApiEntityList->setActiveId($strParameter);
            else
                $this->ApiEntityList->setActiveId(null);
        $theObject = ApiEntity::Load($strParameter);
        if ($theObject) {
            $this->ApiEntityInstance->setObject($theObject);
            $this->ApiEntityInstance->setValues($theObject);
            $this->ApiEntityInstance->refreshAll();
            $this->btnDeleteApiEntity->Visible = true;
            AppSpecificFunctions::ToggleModal('ApiEntityModal');
        }
    }
    protected function ApiEntity_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntity_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntity_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntity_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntity_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityList->setActiveId(null);
        $this->ApiEntityInstance->setObject(null);
        $this->ApiEntityInstance->setValues(null);
        $this->btnDeleteApiEntity->Visible = false;
        AppSpecificFunctions::ToggleModal('ApiEntityModal');
    }
}
ApiEntity_ListForm::Run('ApiEntity_ListForm');
?>