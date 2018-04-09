<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Student/StudentController.php');
require(__SDEV_CONTROLS__.'/Implementations/Student/StudentDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Student_OverviewForm extends QForm {
    // Data grid variables
    protected $StudentGrid;
    protected $StudentWaitControlIcon;
    protected $btnNewStudent;
    protected $selectedStudentId = -1;

    // Student Object variables
    protected $StudentInstance;
    protected $btnSaveStudent,$btnDeleteStudent;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitStudentDataGrid();
        $this->InitStudentModal();
    }
    protected function InitStudentModal() {
        $this->StudentInstance = new StudentController($this);

        $this->btnSaveStudent = new QButton($this);
        $this->btnSaveStudent->Text = 'Save';
        $this->btnSaveStudent->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveStudent->AddAction(new QClickEvent(), new QAjaxAction('btnSaveStudent_Clicked'));

        $this->btnDeleteStudent = new QButton($this);
        $this->btnDeleteStudent->Text = 'Delete';
        $this->btnDeleteStudent->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteStudent->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteStudent->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteStudent_Clicked'));
    }
    protected function btnSaveStudent_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->StudentInstance->saveObject()) {
            $this->StudentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('StudentModal');
        }
    }
    protected function btnDeleteStudent_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->StudentInstance->deleteObject()) {
            $this->StudentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('StudentModal');
        }
    }
    protected function InitStudentDataGrid() {
        $searchableAttributes = array(QQN::Student()->FirstName,QQN::Student()->LastName,QQN::Student()->EmailAddress);
        $headerItems = array('First Name','Last Name','Email Address');
        $headerSortNodes = array(QQN::Student()->FirstName,QQN::Student()->LastName,QQN::Student()->EmailAddress);
        $columnItems = array('FirstName','LastName','EmailAddress');
        $this->StudentWaitControlIcon = new QWaitIcon($this);
        $this->btnNewStudent = new QButton($this);
        $this->btnNewStudent->Text = 'Add Student';
        $this->btnNewStudent->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewStudent->AddAction(new QClickEvent(), new QAjaxAction('btnNewStudent_Clicked'));
        $this->StudentGrid = new StudentDataGrid($this, QQN::Student(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->StudentWaitControlIcon, 'StudentGrid');
    }
    protected function StudentGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->StudentGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function StudentGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->StudentGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function StudentGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->StudentGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function StudentGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->StudentGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function StudentGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->StudentGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function StudentGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedStudentId = $strParameter;
        $theObject = Student::Load($this->selectedStudentId);
        if ($theObject) {
            $this->StudentInstance->setObject($theObject);
            $this->StudentInstance->setValues($theObject);
            $this->StudentInstance->refreshAll();
            $this->btnDeleteStudent->Visible = true;
            AppSpecificFunctions::ToggleModal('StudentModal');
        }
    }
    protected function btnNewStudent_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedStudentId = -1;
        $this->StudentInstance->setObject(null);
        $this->StudentInstance->setValues(null);
        $this->btnDeleteStudent->Visible = false;
        AppSpecificFunctions::ToggleModal('StudentModal');
    }
}
Student_OverviewForm::Run('Student_OverviewForm');
?>