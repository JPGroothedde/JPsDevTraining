<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/RemoteAccess/RemoteAccessController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class RemoteAccess_DetailForm extends QForm {
    // RemoteAccess Object variables
    protected $RemoteAccessInstance;
    protected $btnSaveRemoteAccess,$btnDeleteRemoteAccess,$btnCancelRemoteAccess;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitRemoteAccessInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = RemoteAccess::Load($objId);
            if ($theObject) {
                $this->RemoteAccessInstance->setObject($theObject);
                $this->RemoteAccessInstance->setValues($theObject);
                $this->RemoteAccessInstance->refreshAll();
                $this->btnDeleteRemoteAccess->Visible = true;
            } else {
                $this->RemoteAccessInstance->setObject(null);
                $this->RemoteAccessInstance->setValues(null);
                $this->btnDeleteRemoteAccess->Visible = false;
            }
        } else {
            $this->RemoteAccessInstance->setObject(null);
            $this->RemoteAccessInstance->setValues(null);
            $this->btnDeleteRemoteAccess->Visible = false;
        }
    }
    protected function InitRemoteAccessInstance() {
        $this->RemoteAccessInstance = new RemoteAccessController($this);

        $this->btnSaveRemoteAccess = new QButton($this);
        $this->btnSaveRemoteAccess->Text = 'Save';
        $this->btnSaveRemoteAccess->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnSaveRemoteAccess_Clicked'));

        $this->btnDeleteRemoteAccess = new QButton($this);
        $this->btnDeleteRemoteAccess->Text = 'Delete';
        $this->btnDeleteRemoteAccess->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteRemoteAccess->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteRemoteAccess_Clicked'));

        $this->btnCancelRemoteAccess = new QButton($this);
        $this->btnCancelRemoteAccess->Text = 'Cancel';
        $this->btnCancelRemoteAccess->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelRemoteAccess->AddAction(new QClickEvent(), new QAjaxAction('btnCancelRemoteAccess_Clicked'));
    }
    protected function btnSaveRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->RemoteAccessInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteRemoteAccess_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->RemoteAccessInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
RemoteAccess_DetailForm::Run('RemoteAccess_DetailForm');
?>