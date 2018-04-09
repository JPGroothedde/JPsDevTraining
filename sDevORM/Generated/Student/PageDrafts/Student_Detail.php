<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Student/StudentController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Student_DetailForm extends QForm {
    // Student Object variables
    protected $StudentInstance;
    protected $btnSaveStudent,$btnDeleteStudent,$btnCancelStudent;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitStudentInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Student::Load($objId);
            if ($theObject) {
                $this->StudentInstance->setObject($theObject);
                $this->StudentInstance->setValues($theObject);
                $this->StudentInstance->refreshAll();
                $this->btnDeleteStudent->Visible = true;
            } else {
                $this->StudentInstance->setObject(null);
                $this->StudentInstance->setValues(null);
                $this->btnDeleteStudent->Visible = false;
            }
        } else {
            $this->StudentInstance->setObject(null);
            $this->StudentInstance->setValues(null);
            $this->btnDeleteStudent->Visible = false;
        }
    }
    protected function InitStudentInstance() {
        $this->StudentInstance = new StudentController($this);

        $this->btnSaveStudent = new QButton($this);
        $this->btnSaveStudent->Text = 'Save';
        $this->btnSaveStudent->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveStudent->AddAction(new QClickEvent(), new QAjaxAction('btnSaveStudent_Clicked'));

        $this->btnDeleteStudent = new QButton($this);
        $this->btnDeleteStudent->Text = 'Delete';
        $this->btnDeleteStudent->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteStudent->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteStudent->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteStudent_Clicked'));

        $this->btnCancelStudent = new QButton($this);
        $this->btnCancelStudent->Text = 'Cancel';
        $this->btnCancelStudent->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelStudent->AddAction(new QClickEvent(), new QAjaxAction('btnCancelStudent_Clicked'));
    }
    protected function btnSaveStudent_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->StudentInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteStudent_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->StudentInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelStudent_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Student_DetailForm::Run('Student_DetailForm');
?>