<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Task/TaskController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Task_DetailForm extends QForm {
    // Task Object variables
    protected $TaskInstance;
    protected $btnSaveTask,$btnDeleteTask,$btnCancelTask;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitTaskInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Task::Load($objId);
            if ($theObject) {
                $this->TaskInstance->setObject($theObject);
                $this->TaskInstance->setValues($theObject);
                $this->TaskInstance->refreshAll();
                $this->btnDeleteTask->Visible = true;
            } else {
                $this->TaskInstance->setObject(null);
                $this->TaskInstance->setValues(null);
                $this->btnDeleteTask->Visible = false;
            }
        } else {
            $this->TaskInstance->setObject(null);
            $this->TaskInstance->setValues(null);
            $this->btnDeleteTask->Visible = false;
        }
    }
    protected function InitTaskInstance() {
        $this->TaskInstance = new TaskController($this);

        $this->btnSaveTask = new QButton($this);
        $this->btnSaveTask->Text = 'Save Task';
        $this->btnSaveTask->AddAction(new QClickEvent(), new QAjaxAction('btnSaveTask_Clicked'));

        $this->btnDeleteTask = new QButton($this);
        $this->btnDeleteTask->Text = 'Delete Task';
        $this->btnDeleteTask->CssClass = 'btn btn-danger';
        $this->btnDeleteTask->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteTask->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteTask_Clicked'));

        $this->btnCancelTask = new QButton($this);
        $this->btnCancelTask->Text = 'Cancel';
        $this->btnCancelTask->CssClass = 'btn btn-default';
        $this->btnCancelTask->AddAction(new QClickEvent(), new QAjaxAction('btnCancelTask_Clicked'));
    }
    protected function btnSaveTask_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->TaskInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteTask_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->TaskInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelTask_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Task_DetailForm::Run('Task_DetailForm');
?>