<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateController.php');
require(__SDEV_CONTROLS__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class BackgroundProcessUpdate_ListForm extends QForm {
    // Data list variables
    protected $BackgroundProcessUpdateList;
    protected $btnNewBackgroundProcessUpdate;

    // BackgroundProcessUpdate Object variables
    protected $BackgroundProcessUpdateInstance;
    protected $btnSaveBackgroundProcessUpdate,$btnDeleteBackgroundProcessUpdate;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitBackgroundProcessUpdateDataList();
        $this->InitBackgroundProcessUpdateModal();
    }
    protected function InitBackgroundProcessUpdateModal() {
        $this->BackgroundProcessUpdateInstance = new BackgroundProcessUpdateController($this);

        $this->btnSaveBackgroundProcessUpdate = new QButton($this);
        $this->btnSaveBackgroundProcessUpdate->Text = 'Save';
        $this->btnSaveBackgroundProcessUpdate->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnSaveBackgroundProcessUpdate_Clicked'));

        $this->btnDeleteBackgroundProcessUpdate = new QButton($this);
        $this->btnDeleteBackgroundProcessUpdate->Text = 'Delete';
        $this->btnDeleteBackgroundProcessUpdate->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteBackgroundProcessUpdate->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteBackgroundProcessUpdate_Clicked'));
    }
    protected function btnSaveBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessUpdateInstance->saveObject()) {
            $this->BackgroundProcessUpdateList->refreshList();
            AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
        }
    }
    protected function btnDeleteBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessUpdateInstance->deleteObject()) {
            $this->BackgroundProcessUpdateList->refreshList();
            AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
        }
    }
    protected function InitBackgroundProcessUpdateDataList() {
        $searchableAttributes = array(QQN::BackgroundProcessUpdate()->UpdateDateTime,QQN::BackgroundProcessUpdate()->UpdateMessage,QQN::BackgroundProcessUpdate()->BackgroundProcessObject->Id);
        $SortAttributesShown = array('Update Date Time','Update Message','Background Process Object');
        $SortAttributes = array(QQN::BackgroundProcessUpdate()->UpdateDateTime,QQN::BackgroundProcessUpdate()->UpdateMessage,QQN::BackgroundProcessUpdate()->BackgroundProcessObject->Id);
        $columnItems = array('UpdateDateTime','UpdateMessage','BackgroundProcess');
        $this->btnNewBackgroundProcessUpdate = AppSpecificFunctions::getNewActionButton($this,'Add BackgroundProcessUpdate','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewBackgroundProcessUpdate_Clicked');
        $this->BackgroundProcessUpdateList = new BackgroundProcessUpdateDataList($this, QQN::BackgroundProcessUpdate(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function BackgroundProcessUpdate_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessUpdateList->getActiveId() != $strParameter)
                $this->BackgroundProcessUpdateList->setActiveId($strParameter);
            else
                $this->BackgroundProcessUpdateList->setActiveId(null);
        $theObject = BackgroundProcessUpdate::Load($strParameter);
        if ($theObject) {
            $this->BackgroundProcessUpdateInstance->setObject($theObject);
            $this->BackgroundProcessUpdateInstance->setValues($theObject);
            $this->BackgroundProcessUpdateInstance->refreshAll();
            $this->btnDeleteBackgroundProcessUpdate->Visible = true;
            AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
        }
    }
    protected function BackgroundProcessUpdate_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdate_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdate_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdate_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function BackgroundProcessUpdate_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        $this->BackgroundProcessUpdateList->setActiveId(null);
        $this->BackgroundProcessUpdateInstance->setObject(null);
        $this->BackgroundProcessUpdateInstance->setValues(null);
        $this->btnDeleteBackgroundProcessUpdate->Visible = false;
        AppSpecificFunctions::ToggleModal('BackgroundProcessUpdateModal');
    }
}
BackgroundProcessUpdate_ListForm::Run('BackgroundProcessUpdate_ListForm');
?>