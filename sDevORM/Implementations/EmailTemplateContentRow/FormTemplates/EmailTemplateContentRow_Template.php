<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplateContentRow_DetailForm extends QForm {
    // EmailTemplateContentRow Object variables
    protected $EmailTemplateContentRowInstance;
    protected $btnSaveEmailTemplateContentRow,$btnDeleteEmailTemplateContentRow,$btnCancelEmailTemplateContentRow;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailTemplateContentRowInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = EmailTemplateContentRow::Load($objId);
            if ($theObject) {
                $this->EmailTemplateContentRowInstance->setObject($theObject);
                $this->EmailTemplateContentRowInstance->setValues($theObject);
                $this->EmailTemplateContentRowInstance->refreshAll();
                $this->btnDeleteEmailTemplateContentRow->Visible = true;
            } else {
                $this->EmailTemplateContentRowInstance->setObject(null);
                $this->EmailTemplateContentRowInstance->setValues(null);
                $this->btnDeleteEmailTemplateContentRow->Visible = false;
            }
        } else {
            $this->EmailTemplateContentRowInstance->setObject(null);
            $this->EmailTemplateContentRowInstance->setValues(null);
            $this->btnDeleteEmailTemplateContentRow->Visible = false;
        }
    }
    protected function InitEmailTemplateContentRowInstance() {
        $this->EmailTemplateContentRowInstance = new EmailTemplateContentRowController($this);

        $this->btnSaveEmailTemplateContentRow = new QButton($this);
        $this->btnSaveEmailTemplateContentRow->Text = 'Save EmailTemplateContentRow';
        $this->btnSaveEmailTemplateContentRow->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailTemplateContentRow_Clicked'));

        $this->btnDeleteEmailTemplateContentRow = new QButton($this);
        $this->btnDeleteEmailTemplateContentRow->Text = 'Delete EmailTemplateContentRow';
        $this->btnDeleteEmailTemplateContentRow->CssClass = 'btn btn-danger';
        $this->btnDeleteEmailTemplateContentRow->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailTemplateContentRow->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailTemplateContentRow_Clicked'));

        $this->btnCancelEmailTemplateContentRow = new QButton($this);
        $this->btnCancelEmailTemplateContentRow->Text = 'Cancel';
        $this->btnCancelEmailTemplateContentRow->CssClass = 'btn btn-default';
        $this->btnCancelEmailTemplateContentRow->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEmailTemplateContentRow_Clicked'));
    }
    protected function btnSaveEmailTemplateContentRow_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentRowInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteEmailTemplateContentRow_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentRowInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
EmailTemplateContentRow_DetailForm::Run('EmailTemplateContentRow_DetailForm');
?>