<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ApiEntity/ApiEntityController.php');
require(__SDEV_CONTROLS__.'/Implementations/ApiEntity/ApiEntityDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ApiEntity_OverviewForm extends QForm {
    // Data grid variables
    protected $ApiEntityGrid;
    protected $ApiEntityWaitControlIcon;
    protected $btnNewApiEntity;
    protected $selectedApiEntityId = -1;

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

        $this->InitApiEntityDataGrid();
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
            $this->ApiEntityGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ApiEntityModal');
        }
    }
    protected function btnDeleteApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiEntityInstance->deleteObject()) {
            $this->ApiEntityGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ApiEntityModal');
        }
    }
    protected function InitApiEntityDataGrid() {
        $searchableAttributes = array(QQN::ApiEntity()->EntityName,QQN::ApiEntity()->ApiKeyObject->Id);
        $headerItems = array('Entity Name','Api Key Object');
        $headerSortNodes = array(QQN::ApiEntity()->EntityName,QQN::ApiEntity()->ApiKeyObject->Id);
        $columnItems = array('EntityName','ApiKey');
        $this->ApiEntityWaitControlIcon = new QWaitIcon($this);
        $this->btnNewApiEntity = new QButton($this);
        $this->btnNewApiEntity->Text = 'Add ApiEntity';
        $this->btnNewApiEntity->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewApiEntity->AddAction(new QClickEvent(), new QAjaxAction('btnNewApiEntity_Clicked'));
        $this->ApiEntityGrid = new ApiEntityDataGrid($this, QQN::ApiEntity(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->ApiEntityWaitControlIcon, 'ApiEntityGrid');
    }
    protected function ApiEntityGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntityGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntityGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntityGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntityGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->ApiEntityGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ApiEntityGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedApiEntityId = $strParameter;
        $theObject = ApiEntity::Load($this->selectedApiEntityId);
        if ($theObject) {
            $this->ApiEntityInstance->setObject($theObject);
            $this->ApiEntityInstance->setValues($theObject);
            $this->ApiEntityInstance->refreshAll();
            $this->btnDeleteApiEntity->Visible = true;
            AppSpecificFunctions::ToggleModal('ApiEntityModal');
        }
    }
    protected function btnNewApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedApiEntityId = -1;
        $this->ApiEntityInstance->setObject(null);
        $this->ApiEntityInstance->setValues(null);
        $this->btnDeleteApiEntity->Visible = false;
        AppSpecificFunctions::ToggleModal('ApiEntityModal');
    }
}
ApiEntity_OverviewForm::Run('ApiEntity_OverviewForm');
?>