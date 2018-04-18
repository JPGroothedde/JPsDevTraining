<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyController.php');
require(__SDEV_CONTROLS__.'/Implementations/ApiKey/ApiKeyDataGrid.php');
require(__SDEV_ORM__.'/Implementations/ApiEntity/ApiEntityController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}
class ApiKey_OverviewForm extends QForm {
    // Data grid variables
    protected $ApiKeyGrid;
    protected $ApiKeyWaitControlIcon;
    protected $btnNewApiKey;
    protected $selectedApiKeyId = -1;

    // ApiKey Object variables
    protected $ApiKeyInstance;
    protected $btnSaveApiKey,$btnDeleteApiKey;

    protected $html_ApiEntityList,$actionApiEntityClick;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitApiKeyDataGrid();
        $this->InitApiKeyModal();
        $this->updateApiEntityList();
    }
    protected function InitApiKeyModal() {
        $this->ApiKeyInstance = new ApiKeyController($this);
        $this->html_ApiEntityList = new sUIElementsBase($this);
        $this->actionApiEntityClick = new sUIElementsBase($this);
        $this->actionApiEntityClick->AddAction(new QClickEvent(), new QAjaxAction('actionApiEntityClick'));

        $this->btnSaveApiKey = new QButton($this);
        $this->btnSaveApiKey->Text = 'Save';
        $this->btnSaveApiKey->CssClass = 'btn btn-success '.$this->buttonFullWidthCss;
        $this->btnSaveApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnSaveApiKey_Clicked'));

        $this->btnDeleteApiKey = new QButton($this);
        $this->btnDeleteApiKey->Text = 'Delete ';
        $this->btnDeleteApiKey->CssClass = 'btn btn-danger '.$this->buttonFullWidthCss;
        $this->btnDeleteApiKey->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteApiKey->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteApiKey_Clicked'));
    }
    protected function btnSaveApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiKeyInstance->saveObject(true)) {
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
    protected function updateApiEntityList() {
        $html = '<h4 class="page-header">Entity Access</h4>';
        $tempApiEntityInstance = new ApiEntityController($this);
        $ApiEntities = $this->GetControl($tempApiEntityInstance->getControlId('EntityName'))->GetAllItems();
        foreach ($ApiEntities as $lstItem) {
            $alreadyAssignedEntity = ApiEntity::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::ApiEntity()->ApiKeyObject->Id,$this->ApiKeyInstance->getObjectId()),
                QQ::Equal(QQN::ApiEntity()->EntityName,$lstItem->Value)));
            if ($alreadyAssignedEntity) {
                $html .= '<button type="button" onclick="'.AppSpecificFunctions::getPostBackJs($this->FormId,$this->actionApiEntityClick->getJqControlId(),$lstItem->Value).'"
                                    class="list-group-item list-group-item-success"><i class="fa fa-check" aria-hidden="true"></i> '.$lstItem->Value.'</button>';
            }
            else {
                $html .= '<button type="button" onclick="'.AppSpecificFunctions::getPostBackJs($this->FormId,$this->actionApiEntityClick->getJqControlId(),$lstItem->Value).'"
                                    class="list-group-item list-group-item-danger"><i class="fa fa-lock" aria-hidden="true"></i> '.$lstItem->Value.'</button>';
            }

        }
        $this->html_ApiEntityList->updateControl($html);
    }
    protected function actionApiEntityClick($strFormId, $strControlId, $strParameter) {
        if (!$this->ApiKeyInstance->saveObject(true)) {
            return;
        }
        $this->btnDeleteApiKey->Visible = true;
        $alreadyAssignedEntity = ApiEntity::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::ApiEntity()->ApiKeyObject->Id,$this->ApiKeyInstance->getObjectId()),
            QQ::Equal(QQN::ApiEntity()->EntityName,$strParameter)));
        if ($alreadyAssignedEntity) {
            $alreadyAssignedEntity->Delete();
        } else {
            $newEntity = new ApiEntity();

            $newEntity->ApiKeyObject = $this->ApiKeyInstance->getObject();
            $newEntity->EntityName = $strParameter;
            try {
                $newEntity->Save();
            } catch (QCallerException $e) {

            }
        }
        $this->updateApiEntityList();
    }
    protected function InitApiKeyDataGrid() {
        $searchableAttributes = array(QQN::ApiKey()->ApiKey,QQN::ApiKey()->Status);
        $headerItems = array('Api Key','Status');
        $headerSortNodes = array(QQN::ApiKey()->ApiKey,QQN::ApiKey()->Status);
        $columnItems = array('ApiKey','Status');
        $this->ApiKeyWaitControlIcon = new QWaitIcon($this);
        $this->btnNewApiKey = new QButton($this);
        $this->btnNewApiKey->Text = 'Add Api Key';
        $this->btnNewApiKey->AddCssClass('pull-right mrg-topMin55');
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
            $this->updateApiEntityList();
            AppSpecificFunctions::ToggleModal('ApiKeyModal');
        }
    }
    protected function btnNewApiKey_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedApiKeyId = -1;
        $this->ApiKeyInstance->setObject(null);
        $this->ApiKeyInstance->setValues(null);
        $this->btnDeleteApiKey->Visible = false;
        $this->updateApiEntityList();
        $this->ApiKeyInstance->setValue('ApiKey',$this->getNewApiKey());
        AppSpecificFunctions::ToggleModal('ApiKeyModal');
    }
    protected function getNewApiKey() {
        $newKey = AppSpecificFunctions::generateRandomString(50);
        $done = false;
        $limit = 0;
        while (!$done) {
            $limit++;
            $newKey = AppSpecificFunctions::generateRandomString(50);
            $existingApiKey = ApiKey::LoadByApiKey($newKey);
            if (!$existingApiKey)
                $done = true;
            if ($limit > 100) {
                $newKey = '';
                $done = true;
            }
        }
        return $newKey;
    }
}
ApiKey_OverviewForm::Run('ApiKey_OverviewForm');
?>