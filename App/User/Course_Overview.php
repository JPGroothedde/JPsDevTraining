<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Course/CourseController.php');
require(__SDEV_CONTROLS__.'/Implementations/Course/CourseDataGrid.php');
if (!AppSpecificFunctions::checkPageAccess(array('User'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login.php/');
}
AppSpecificFunctions::CheckRemoteAdmin();
class Course_OverviewForm extends QForm {
    // Data grid variables
    protected $CourseGrid;
    protected $CourseWaitControlIcon;
    protected $btnNewCourse;
    protected $selectedCourseId = -1;

    // Course Object variables
    protected $CourseInstance;
    protected $btnSaveCourse,$btnDeleteCourse,$btnViewCourseSubscriptions;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitCourseDataGrid();
        $this->InitCourseModal();
    }
    protected function InitCourseModal() {
        $this->CourseInstance = new CourseController($this);
	
	    $this->btnViewCourseSubscriptions = new QButton($this);
	    $this->btnViewCourseSubscriptions->Text = 'View Subscriptions';
	    $this->btnViewCourseSubscriptions->CssClass = 'btn btn-info rippleclick mrg-top10 fullWidth';
	    $this->btnViewCourseSubscriptions->AddAction(new QClickEvent(), new QAjaxAction('btnViewCourseSubscription_Clicked'));

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
	protected function btnViewCourseSubscription_Clicked($strFormId, $strControlId, $strParameter){
		AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'App/User/Subscription_Overview/'.$this->CourseInstance->getObjectId());
	}
    protected function btnSaveCourse_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CourseInstance->saveObject()) {
            $this->CourseGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('CourseModal');
        }
    }
    protected function btnDeleteCourse_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CourseInstance->deleteObject()) {
            $this->CourseGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('CourseModal');
        }
    }
    protected function InitCourseDataGrid() {
        $searchableAttributes = array(QQN::Course()->CourseName,QQN::Course()->CoursePrice);
        $headerItems = array('Course Name','Course Price');
        $headerSortNodes = array(QQN::Course()->CourseName,QQN::Course()->CoursePrice);
        $columnItems = array('CourseName','CoursePrice');
        $this->CourseWaitControlIcon = new QWaitIcon($this);
        $this->btnNewCourse = new QButton($this);
        $this->btnNewCourse->Text = 'Add Course';
        $this->btnNewCourse->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewCourse->AddAction(new QClickEvent(), new QAjaxAction('btnNewCourse_Clicked'));
        $this->CourseGrid = new CourseDataGrid($this, QQN::Course(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->CourseWaitControlIcon, 'CourseGrid');
    }
    protected function CourseGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CourseGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CourseGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CourseGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CourseGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CourseGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CourseGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CourseGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CourseGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->CourseGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function CourseGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedCourseId = $strParameter;
        $theObject = Course::Load($this->selectedCourseId);
        if ($theObject) {
            $this->CourseInstance->setObject($theObject);
            $this->CourseInstance->setValues($theObject);
            $this->CourseInstance->refreshAll();
            $this->btnViewCourseSubscriptions->Visible = true;
            $this->btnDeleteCourse->Visible = true;
            AppSpecificFunctions::ToggleModal('CourseModal');
        }
    }
    protected function btnNewCourse_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedCourseId = -1;
        $this->CourseInstance->setObject(null);
        $this->CourseInstance->setValues(null);
        $this->btnViewCourseSubscriptions->Visible = false;
        $this->btnDeleteCourse->Visible = false;
        AppSpecificFunctions::ToggleModal('CourseModal');
    }
}
Course_OverviewForm::Run('Course_OverviewForm');
?>