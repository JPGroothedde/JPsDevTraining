<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Course/CourseController.php');
require(__SDEV_CONTROLS__.'/Implementations/Course/CourseDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Course_ListForm extends QForm {
    // Data list variables
    protected $CourseList;
    protected $btnNewCourse;

    // Course Object variables
    protected $CourseInstance;
    protected $btnSaveCourse,$btnDeleteCourse;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitCourseDataList();
        $this->InitCourseModal();
    }
    protected function InitCourseModal() {
        $this->CourseInstance = new CourseController($this);

        $this->btnSaveCourse = new QButton($this);
        $this->btnSaveCourse->Text = 'Save';
        $this->btnSaveCourse->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveCourse->AddAction(new QClickEvent(), new QAjaxAction('btnSaveCourse_Clicked'));

        $this->btnDeleteCourse = new QButton($this);
        $this->btnDeleteCourse->Text = 'Delete';
        $this->btnDeleteCourse->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteCourse->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteCourse->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteCourse_Clicked'));
    }
    protected function btnSaveCourse_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CourseInstance->saveObject()) {
            $this->CourseList->refreshList();
            AppSpecificFunctions::ToggleModal('CourseModal');
        }
    }
    protected function btnDeleteCourse_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CourseInstance->deleteObject()) {
            $this->CourseList->refreshList();
            AppSpecificFunctions::ToggleModal('CourseModal');
        }
    }
    protected function InitCourseDataList() {
        $searchableAttributes = array(QQN::Course()->CourseName,QQN::Course()->CoursePrice);
        $SortAttributesShown = array('Course Name','Course Price');
        $SortAttributes = array(QQN::Course()->CourseName,QQN::Course()->CoursePrice);
        $columnItems = array('CourseName','CoursePrice');
        $this->btnNewCourse = AppSpecificFunctions::getNewActionButton($this,'Add Course','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewCourse_Clicked');
        $this->CourseList = new CourseDataList($this, QQN::Course(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Course_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->CourseList->getActiveId() != $strParameter)
                $this->CourseList->setActiveId($strParameter);
            else
                $this->CourseList->setActiveId(null);
        $theObject = Course::Load($strParameter);
        if ($theObject) {
            $this->CourseInstance->setObject($theObject);
            $this->CourseInstance->setValues($theObject);
            $this->CourseInstance->refreshAll();
            $this->btnDeleteCourse->Visible = true;
            AppSpecificFunctions::ToggleModal('CourseModal');
        }
    }
    protected function Course_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->CourseList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Course_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->CourseList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Course_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->CourseList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Course_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->CourseList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Course_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->CourseList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewCourse_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CourseList->setActiveId(null);
        $this->CourseInstance->setObject(null);
        $this->CourseInstance->setValues(null);
        $this->btnDeleteCourse->Visible = false;
        AppSpecificFunctions::ToggleModal('CourseModal');
    }
}
Course_ListForm::Run('Course_ListForm');
?>