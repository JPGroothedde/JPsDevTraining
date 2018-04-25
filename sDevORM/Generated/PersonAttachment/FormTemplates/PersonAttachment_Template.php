<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/PersonAttachment/PersonAttachmentController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonAttachment_DetailForm extends QForm {
    // PersonAttachment Object variables
    protected $PersonAttachmentInstance;
    protected $btnSavePersonAttachment,$btnDeletePersonAttachment,$btnCancelPersonAttachment;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonAttachmentInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PersonAttachment::Load($objId);
            if ($theObject) {
                $this->PersonAttachmentInstance->setObject($theObject);
                $this->PersonAttachmentInstance->setValues($theObject);
                $this->PersonAttachmentInstance->refreshAll();
                $this->btnDeletePersonAttachment->Visible = true;
            } else {
                $this->PersonAttachmentInstance->setObject(null);
                $this->PersonAttachmentInstance->setValues(null);
                $this->btnDeletePersonAttachment->Visible = false;
            }
        } else {
            $this->PersonAttachmentInstance->setObject(null);
            $this->PersonAttachmentInstance->setValues(null);
            $this->btnDeletePersonAttachment->Visible = false;
        }
    }
    protected function InitPersonAttachmentInstance() {
        $this->PersonAttachmentInstance = new PersonAttachmentController($this);

        $this->btnSavePersonAttachment = new QButton($this);
        $this->btnSavePersonAttachment->Text = 'Save';
        $this->btnSavePersonAttachment->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonAttachment_Clicked'));

        $this->btnDeletePersonAttachment = new QButton($this);
        $this->btnDeletePersonAttachment->Text = 'Delete';
        $this->btnDeletePersonAttachment->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePersonAttachment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonAttachment_Clicked'));

        $this->btnCancelPersonAttachment = new QButton($this);
        $this->btnCancelPersonAttachment->Text = 'Cancel';
        $this->btnCancelPersonAttachment->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPersonAttachment_Clicked'));
    }
    protected function btnSavePersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonAttachmentInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeletePersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonAttachmentInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
PersonAttachment_DetailForm::Run('PersonAttachment_DetailForm');
?>