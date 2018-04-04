<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/RemoteAccess/RemoteAccessController.php');
require(__SDEV_CONTROLS__.'/Implementations/RemoteAccess/RemoteAccessDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class RemoteAccess_ListForm extends QForm {
    // Data list variables
    protected $RemoteAccessList;
    protected $btnNewRemoteAccess;

    // RemoteAccess Object variables
    protected $RemoteAccessInstance;
    protected $btnSaveRemoteAccess,$btnDeleteRemoteAccess;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitRemoteAccessDataList();
        $this->InitRemoteAccessModal();
    }
    protected function InitRemoteAccessModal() {
        $this->RemoteAccessInstance = new RemoteAccessController($this);

        $this->btnSaveRemoteAccess = new QButton($this);
        $this->btnSaveRemoteAccess->Text = 'Save';
        $this->btnSaveRemoteAccess->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnSaveRemoteAccess_Clicked'));

        $this->btnDeleteRemoteAccess = new QButton($this);
        $this->btnDeleteRemoteAccess->Text = 'Delete';
        $this->btnDeleteRemoteAccess->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteRemoteAccess->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteRemoteAccess_Clicked'));
    }
    protected function btnSaveRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->RemoteAccessInstance->saveObject()) {
            $this->RemoteAccessList->refreshList();
            AppSpecificFunctions::ToggleModal('RemoteAccessModal');
        }
    }
    protected function btnDeleteRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->RemoteAccessInstance->deleteObject()) {
            $this->RemoteAccessList->refreshList();
            AppSpecificFunctions::ToggleModal('RemoteAccessModal');
        }
    }
    protected function InitRemoteAccessDataList() {
        $searchableAttributes = array(QQN::RemoteAccess()->IpAddress,QQN::RemoteAccess()->AccessDateTime);
        $SortAttributesShown = array('Ip Address','Access Date Time');
        $SortAttributes = array(QQN::RemoteAccess()->IpAddress,QQN::RemoteAccess()->AccessDateTime);
        $columnItems = array('IpAddress','AccessDateTime');
        $this->btnNewRemoteAccess = AppSpecificFunctions::getNewActionButton($this,'Add RemoteAccess','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewRemoteAccess_Clicked');
        $this->RemoteAccessList = new RemoteAccessDataList($this, QQN::RemoteAccess(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function RemoteAccess_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->RemoteAccessList->getActiveId() != $strParameter)
                $this->RemoteAccessList->setActiveId($strParameter);
            else
                $this->RemoteAccessList->setActiveId(null);
        $theObject = RemoteAccess::Load($strParameter);
        if ($theObject) {
            $this->RemoteAccessInstance->setObject($theObject);
            $this->RemoteAccessInstance->setValues($theObject);
            $this->RemoteAccessInstance->refreshAll();
            $this->btnDeleteRemoteAccess->Visible = true;
            AppSpecificFunctions::ToggleModal('RemoteAccessModal');
        }
    }
    protected function RemoteAccess_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccess_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccess_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccess_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function RemoteAccess_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        $this->RemoteAccessList->setActiveId(null);
        $this->RemoteAccessInstance->setObject(null);
        $this->RemoteAccessInstance->setValues(null);
        $this->btnDeleteRemoteAccess->Visible = false;
        AppSpecificFunctions::ToggleModal('RemoteAccessModal');
    }
}
RemoteAccess_ListForm::Run('RemoteAccess_ListForm');
?>