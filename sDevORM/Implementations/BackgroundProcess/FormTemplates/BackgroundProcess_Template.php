<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/BackgroundProcess/BackgroundProcessController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class BackgroundProcess_DetailForm extends QForm {
    // BackgroundProcess Object variables
    protected $BackgroundProcessInstance;
    protected $btnSaveBackgroundProcess,$btnDeleteBackgroundProcess,$btnCancelBackgroundProcess;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitBackgroundProcessInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = BackgroundProcess::Load($objId);
            if ($theObject) {
                $this->BackgroundProcessInstance->setObject($theObject);
                $this->BackgroundProcessInstance->setValues($theObject);
                $this->BackgroundProcessInstance->refreshAll();
                $this->btnDeleteBackgroundProcess->Visible = true;
            } else {
                $this->BackgroundProcessInstance->setObject(null);
                $this->BackgroundProcessInstance->setValues(null);
                $this->btnDeleteBackgroundProcess->Visible = false;
            }
        } else {
            $this->BackgroundProcessInstance->setObject(null);
            $this->BackgroundProcessInstance->setValues(null);
            $this->btnDeleteBackgroundProcess->Visible = false;
        }
    }
    protected function InitBackgroundProcessInstance() {
        $this->BackgroundProcessInstance = new BackgroundProcessController($this);

        $this->btnSaveBackgroundProcess = new QButton($this);
        $this->btnSaveBackgroundProcess->Text = 'Save';
        $this->btnSaveBackgroundProcess->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveBackgroundProcess->AddAction(new QClickEvent(), new QAjaxAction('btnSaveBackgroundProcess_Clicked'));

        $this->btnDeleteBackgroundProcess = new QButton($this);
        $this->btnDeleteBackgroundProcess->Text = 'Delete';
        $this->btnDeleteBackgroundProcess->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteBackgroundProcess->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteBackgroundProcess->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteBackgroundProcess_Clicked'));

        $this->btnCancelBackgroundProcess = new QButton($this);
        $this->btnCancelBackgroundProcess->Text = 'Cancel';
        $this->btnCancelBackgroundProcess->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelBackgroundProcess->AddAction(new QClickEvent(), new QAjaxAction('btnCancelBackgroundProcess_Clicked'));
    }
    protected function btnSaveBackgroundProcess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteBackgroundProcess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
BackgroundProcess_DetailForm::Run('BackgroundProcess_DetailForm');
?>