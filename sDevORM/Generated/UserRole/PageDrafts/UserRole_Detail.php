<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/UserRole/UserRoleController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class UserRole_DetailForm extends QForm {
    // UserRole Object variables
    protected $UserRoleInstance;
    protected $btnSaveUserRole,$btnDeleteUserRole,$btnCancelUserRole;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitUserRoleInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = UserRole::Load($objId);
            if ($theObject) {
                $this->UserRoleInstance->setObject($theObject);
                $this->UserRoleInstance->setValues($theObject);
                $this->UserRoleInstance->refreshAll();
                $this->btnDeleteUserRole->Visible = true;
            } else {
                $this->UserRoleInstance->setObject(null);
                $this->UserRoleInstance->setValues(null);
                $this->btnDeleteUserRole->Visible = false;
            }
        } else {
            $this->UserRoleInstance->setObject(null);
            $this->UserRoleInstance->setValues(null);
            $this->btnDeleteUserRole->Visible = false;
        }
    }
    protected function InitUserRoleInstance() {
        $this->UserRoleInstance = new UserRoleController($this);

        $this->btnSaveUserRole = new QButton($this);
        $this->btnSaveUserRole->Text = 'Save';
        $this->btnSaveUserRole->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveUserRole->AddAction(new QClickEvent(), new QAjaxAction('btnSaveUserRole_Clicked'));

        $this->btnDeleteUserRole = new QButton($this);
        $this->btnDeleteUserRole->Text = 'Delete';
        $this->btnDeleteUserRole->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteUserRole->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteUserRole->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteUserRole_Clicked'));

        $this->btnCancelUserRole = new QButton($this);
        $this->btnCancelUserRole->Text = 'Cancel';
        $this->btnCancelUserRole->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelUserRole->AddAction(new QClickEvent(), new QAjaxAction('btnCancelUserRole_Clicked'));
    }
    protected function btnSaveUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->UserRoleInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->UserRoleInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelUserRole_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
UserRole_DetailForm::Run('UserRole_DetailForm');
?>