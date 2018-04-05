<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Assignment/AssignmentController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Assignment_DetailForm extends QForm {
    // Assignment Object variables
    protected $AssignmentInstance;
    protected $btnSaveAssignment,$btnDeleteAssignment,$btnCancelAssignment;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitAssignmentInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Assignment::Load($objId);
            if ($theObject) {
                $this->AssignmentInstance->setObject($theObject);
                $this->AssignmentInstance->setValues($theObject);
                $this->AssignmentInstance->refreshAll();
                $this->btnDeleteAssignment->Visible = true;
            } else {
                $this->AssignmentInstance->setObject(null);
                $this->AssignmentInstance->setValues(null);
                $this->btnDeleteAssignment->Visible = false;
            }
        } else {
            $this->AssignmentInstance->setObject(null);
            $this->AssignmentInstance->setValues(null);
            $this->btnDeleteAssignment->Visible = false;
        }
    }
    protected function InitAssignmentInstance() {
        $this->AssignmentInstance = new AssignmentController($this);

        $this->btnSaveAssignment = new QButton($this);
        $this->btnSaveAssignment->Text = 'Save';
        $this->btnSaveAssignment->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveAssignment->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAssignment_Clicked'));

        $this->btnDeleteAssignment = new QButton($this);
        $this->btnDeleteAssignment->Text = 'Delete';
        $this->btnDeleteAssignment->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteAssignment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAssignment->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAssignment_Clicked'));

        $this->btnCancelAssignment = new QButton($this);
        $this->btnCancelAssignment->Text = 'Cancel';
        $this->btnCancelAssignment->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelAssignment->AddAction(new QClickEvent(), new QAjaxAction('btnCancelAssignment_Clicked'));
    }
    protected function btnSaveAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AssignmentInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AssignmentInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Assignment_DetailForm::Run('Assignment_DetailForm');
?>