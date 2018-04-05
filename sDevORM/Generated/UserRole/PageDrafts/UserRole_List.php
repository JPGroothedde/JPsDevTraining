<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/UserRole/UserRoleController.php');
require(__SDEV_CONTROLS__.'/Implementations/UserRole/UserRoleDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class UserRole_ListForm extends QForm {
    // Data list variables
    protected $UserRoleList;
    protected $btnNewUserRole;

    // UserRole Object variables
    protected $UserRoleInstance;
    protected $btnSaveUserRole,$btnDeleteUserRole;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitUserRoleDataList();
        $this->InitUserRoleModal();
    }
    protected function InitUserRoleModal() {
        $this->UserRoleInstance = new UserRoleController($this);

        $this->btnSaveUserRole = new QButton($this);
        $this->btnSaveUserRole->Text = 'Save';
        $this->btnSaveUserRole->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveUserRole->AddAction(new QClickEvent(), new QAjaxAction('btnSaveUserRole_Clicked'));

        $this->btnDeleteUserRole = new QButton($this);
        $this->btnDeleteUserRole->Text = 'Delete';
        $this->btnDeleteUserRole->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteUserRole->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteUserRole->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteUserRole_Clicked'));
    }
    protected function btnSaveUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->UserRoleInstance->saveObject()) {
            $this->UserRoleList->refreshList();
            AppSpecificFunctions::ToggleModal('UserRoleModal');
        }
    }
    protected function btnDeleteUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->UserRoleInstance->deleteObject()) {
            $this->UserRoleList->refreshList();
            AppSpecificFunctions::ToggleModal('UserRoleModal');
        }
    }
    protected function InitUserRoleDataList() {
        $searchableAttributes = array(QQN::UserRole()->Role);
        $SortAttributesShown = array('Role');
        $SortAttributes = array(QQN::UserRole()->Role);
        $columnItems = array('Role');
        $this->btnNewUserRole = AppSpecificFunctions::getNewActionButton($this,'Add UserRole','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewUserRole_Clicked');
        $this->UserRoleList = new UserRoleDataList($this, QQN::UserRole(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function UserRole_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->UserRoleList->getActiveId() != $strParameter)
                $this->UserRoleList->setActiveId($strParameter);
            else
                $this->UserRoleList->setActiveId(null);
        $theObject = UserRole::Load($strParameter);
        if ($theObject) {
            $this->UserRoleInstance->setObject($theObject);
            $this->UserRoleInstance->setValues($theObject);
            $this->UserRoleInstance->refreshAll();
            $this->btnDeleteUserRole->Visible = true;
            AppSpecificFunctions::ToggleModal('UserRoleModal');
        }
    }
    protected function UserRole_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->UserRoleList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function UserRole_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->UserRoleList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function UserRole_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->UserRoleList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function UserRole_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->UserRoleList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function UserRole_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->UserRoleList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        $this->UserRoleList->setActiveId(null);
        $this->UserRoleInstance->setObject(null);
        $this->UserRoleInstance->setValues(null);
        $this->btnDeleteUserRole->Visible = false;
        AppSpecificFunctions::ToggleModal('UserRoleModal');
    }
}
UserRole_ListForm::Run('UserRole_ListForm');
?>