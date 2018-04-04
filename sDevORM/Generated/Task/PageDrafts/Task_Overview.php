<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Task/TaskController.php');
require(__SDEV_CONTROLS__.'/Implementations/Task/TaskDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Task_OverviewForm extends QForm {
    // Data grid variables
    protected $TaskGrid;
    protected $TaskWaitControlIcon;
    protected $btnNewTask;
    protected $selectedTaskId = -1;

    // Task Object variables
    protected $TaskInstance;
    protected $btnSaveTask,$btnDeleteTask;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitTaskDataGrid();
        $this->InitTaskModal();
    }
    protected function InitTaskModal() {
        $this->TaskInstance = new TaskController($this);

        $this->btnSaveTask = new QButton($this);
        $this->btnSaveTask->Text = 'Save Task';
        $this->btnSaveTask->CssClass = 'btn btn-success '.$this->buttonFullWidthCss;
        $this->btnSaveTask->AddAction(new QClickEvent(), new QAjaxAction('btnSaveTask_Clicked'));

        $this->btnDeleteTask = new QButton($this);
        $this->btnDeleteTask->Text = 'Delete Task';
        $this->btnDeleteTask->CssClass = 'btn btn-danger '.$this->buttonFullWidthCss;
        $this->btnDeleteTask->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteTask->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteTask_Clicked'));
    }
    protected function btnSaveTask_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->TaskInstance->saveObject()) {
            $this->TaskGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('TaskModal');
        }
    }
    protected function btnDeleteTask_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->TaskInstance->deleteObject()) {
            $this->TaskGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('TaskModal');
        }
    }
    protected function InitTaskDataGrid() {
        $searchableAttributes = array(QQN::Task()->Name,QQN::Task()->Description,QQN::Task()->DueDate,QQN::Task()->Status);
        $headerItems = array('Name','Description','Due Date','Status');
        $headerSortNodes = array(QQN::Task()->Name,QQN::Task()->Description,QQN::Task()->DueDate,QQN::Task()->Status);
        $columnItems = array('Name','Description','DueDate','Status');
        $this->TaskWaitControlIcon = new QWaitIcon($this);
        $this->btnNewTask = new QButton($this);
        $this->btnNewTask->Text = 'Add Task';
        $this->btnNewTask->CssClass = 'btn btn-primary '.$this->buttonFullWidthCss;
        $this->btnNewTask->AddAction(new QClickEvent(), new QAjaxAction('btnNewTask_Clicked'));
        $this->TaskGrid = new TaskDataGrid($this, QQN::Task(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->TaskWaitControlIcon, 'TaskGrid');
    }
    protected function TaskGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->TaskGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function TaskGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->TaskGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function TaskGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->TaskGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function TaskGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->TaskGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function TaskGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->TaskGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function TaskGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedTaskId = $strParameter;
        $theObject = Task::Load($this->selectedTaskId);
        if ($theObject) {
            $this->TaskInstance->setObject($theObject);
            $this->TaskInstance->setValues($theObject);
            $this->TaskInstance->refreshAll();
            $this->btnDeleteTask->Visible = true;
            AppSpecificFunctions::ToggleModal('TaskModal');
        }
    }
    protected function btnNewTask_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedTaskId = -1;
        $this->TaskInstance->setObject(null);
        $this->TaskInstance->setValues(null);
        $this->btnDeleteTask->Visible = false;
        AppSpecificFunctions::ToggleModal('TaskModal');
    }
}
Task_OverviewForm::Run('Task_OverviewForm');
?>