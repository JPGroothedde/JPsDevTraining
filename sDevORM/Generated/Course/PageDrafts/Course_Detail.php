<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Course/CourseController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Course_DetailForm extends QForm {
    // Course Object variables
    protected $CourseInstance;
    protected $btnSaveCourse,$btnDeleteCourse,$btnCancelCourse;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitCourseInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Course::Load($objId);
            if ($theObject) {
                $this->CourseInstance->setObject($theObject);
                $this->CourseInstance->setValues($theObject);
                $this->CourseInstance->refreshAll();
                $this->btnDeleteCourse->Visible = true;
            } else {
                $this->CourseInstance->setObject(null);
                $this->CourseInstance->setValues(null);
                $this->btnDeleteCourse->Visible = false;
            }
        } else {
            $this->CourseInstance->setObject(null);
            $this->CourseInstance->setValues(null);
            $this->btnDeleteCourse->Visible = false;
        }
    }
    protected function InitCourseInstance() {
        $this->CourseInstance = new CourseController($this);

        $this->btnSaveCourse = new QButton($this);
        $this->btnSaveCourse->Text = 'Save';
        $this->btnSaveCourse->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveCourse->AddAction(new QClickEvent(), new QAjaxAction('btnSaveCourse_Clicked'));

        $this->btnDeleteCourse = new QButton($this);
        $this->btnDeleteCourse->Text = 'Delete';
        $this->btnDeleteCourse->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteCourse->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteCourse->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteCourse_Clicked'));

        $this->btnCancelCourse = new QButton($this);
        $this->btnCancelCourse->Text = 'Cancel';
        $this->btnCancelCourse->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelCourse->AddAction(new QClickEvent(), new QAjaxAction('btnCancelCourse_Clicked'));
    }
    protected function btnSaveCourse_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CourseInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteCourse_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CourseInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelCourse_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Course_DetailForm::Run('Course_DetailForm');
?>