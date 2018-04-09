<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Student/StudentController.php');
require(__SDEV_CONTROLS__.'/Implementations/Student/StudentDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Student_ListForm extends QForm {
    // Data list variables
    protected $StudentList;
    protected $btnNewStudent;

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

        $this->InitStudentDataList();
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
            $this->StudentList->refreshList();
            AppSpecificFunctions::ToggleModal('StudentModal');
        }
    }
    protected function btnDeleteStudent_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->StudentInstance->deleteObject()) {
            $this->StudentList->refreshList();
            AppSpecificFunctions::ToggleModal('StudentModal');
        }
    }
    protected function InitStudentDataList() {
        $searchableAttributes = array(QQN::Student()->FirstName,QQN::Student()->LastName,QQN::Student()->EmailAddress);
        $SortAttributesShown = array('First Name','Last Name','Email Address');
        $SortAttributes = array(QQN::Student()->FirstName,QQN::Student()->LastName,QQN::Student()->EmailAddress);
        $columnItems = array('FirstName','LastName','EmailAddress');
        $this->btnNewStudent = AppSpecificFunctions::getNewActionButton($this,'Add Student','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewStudent_Clicked');
        $this->StudentList = new StudentDataList($this, QQN::Student(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Student_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->StudentList->getActiveId() != $strParameter)
                $this->StudentList->setActiveId($strParameter);
            else
                $this->StudentList->setActiveId(null);
        $theObject = Student::Load($strParameter);
        if ($theObject) {
            $this->StudentInstance->setObject($theObject);
            $this->StudentInstance->setValues($theObject);
            $this->StudentInstance->refreshAll();
            $this->btnDeleteStudent->Visible = true;
            AppSpecificFunctions::ToggleModal('StudentModal');
        }
    }
    protected function Student_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->StudentList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Student_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->StudentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Student_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->StudentList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Student_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->StudentList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Student_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->StudentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewStudent_Clicked($strFormId, $strControlId, $strParameter) {
        $this->StudentList->setActiveId(null);
        $this->StudentInstance->setObject(null);
        $this->StudentInstance->setValues(null);
        $this->btnDeleteStudent->Visible = false;
        AppSpecificFunctions::ToggleModal('StudentModal');
    }
}
Student_ListForm::Run('Student_ListForm');
?>