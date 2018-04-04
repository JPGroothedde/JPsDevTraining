<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/UserRole/UserRoleController.php');
require(__SDEV_CONTROLS__.'/Implementations/UserRole/UserRoleDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class UserRole_OverviewForm extends QForm {
    // Data grid variables
    protected $UserRoleGrid;
    protected $UserRoleWaitControlIcon;
    protected $btnNewUserRole;
    protected $selectedUserRoleId = -1;

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

        $this->InitUserRoleDataGrid();
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
            $this->UserRoleGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('UserRoleModal');
        }
    }
    protected function btnDeleteUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->UserRoleInstance->deleteObject()) {
            $this->UserRoleGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('UserRoleModal');
        }
    }
    protected function InitUserRoleDataGrid() {
        $searchableAttributes = array(QQN::UserRole()->Role);
        $headerItems = array('Role');
        $headerSortNodes = array(QQN::UserRole()->Role);
        $columnItems = array('Role');
        $this->UserRoleWaitControlIcon = new QWaitIcon($this);
        $this->btnNewUserRole = new QButton($this);
        $this->btnNewUserRole->Text = 'Add UserRole';
        $this->btnNewUserRole->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewUserRole->AddAction(new QClickEvent(), new QAjaxAction('btnNewUserRole_Clicked'));
        $this->UserRoleGrid = new UserRoleDataGrid($this, QQN::UserRole(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->UserRoleWaitControlIcon, 'UserRoleGrid');
    }
    protected function UserRoleGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->UserRoleGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function UserRoleGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->UserRoleGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function UserRoleGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->UserRoleGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function UserRoleGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->UserRoleGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function UserRoleGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->UserRoleGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function UserRoleGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedUserRoleId = $strParameter;
        $theObject = UserRole::Load($this->selectedUserRoleId);
        if ($theObject) {
            $this->UserRoleInstance->setObject($theObject);
            $this->UserRoleInstance->setValues($theObject);
            $this->UserRoleInstance->refreshAll();
            $this->btnDeleteUserRole->Visible = true;
            AppSpecificFunctions::ToggleModal('UserRoleModal');
        }
    }
    protected function btnNewUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedUserRoleId = -1;
        $this->UserRoleInstance->setObject(null);
        $this->UserRoleInstance->setValues(null);
        $this->btnDeleteUserRole->Visible = false;
        AppSpecificFunctions::ToggleModal('UserRoleModal');
    }
}
UserRole_OverviewForm::Run('UserRole_OverviewForm');
?>