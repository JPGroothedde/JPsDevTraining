<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplateContentBlock_DetailForm extends QForm {
    // EmailTemplateContentBlock Object variables
    protected $EmailTemplateContentBlockInstance;
    protected $btnSaveEmailTemplateContentBlock,$btnDeleteEmailTemplateContentBlock,$btnCancelEmailTemplateContentBlock;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailTemplateContentBlockInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = EmailTemplateContentBlock::Load($objId);
            if ($theObject) {
                $this->EmailTemplateContentBlockInstance->setObject($theObject);
                $this->EmailTemplateContentBlockInstance->setValues($theObject);
                $this->EmailTemplateContentBlockInstance->refreshAll();
                $this->btnDeleteEmailTemplateContentBlock->Visible = true;
            } else {
                $this->EmailTemplateContentBlockInstance->setObject(null);
                $this->EmailTemplateContentBlockInstance->setValues(null);
                $this->btnDeleteEmailTemplateContentBlock->Visible = false;
            }
        } else {
            $this->EmailTemplateContentBlockInstance->setObject(null);
            $this->EmailTemplateContentBlockInstance->setValues(null);
            $this->btnDeleteEmailTemplateContentBlock->Visible = false;
        }
    }
    protected function InitEmailTemplateContentBlockInstance() {
        $this->EmailTemplateContentBlockInstance = new EmailTemplateContentBlockController($this);

        $this->btnSaveEmailTemplateContentBlock = new QButton($this);
        $this->btnSaveEmailTemplateContentBlock->Text = 'Save';
        $this->btnSaveEmailTemplateContentBlock->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveEmailTemplateContentBlock->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailTemplateContentBlock_Clicked'));

        $this->btnDeleteEmailTemplateContentBlock = new QButton($this);
        $this->btnDeleteEmailTemplateContentBlock->Text = 'Delete';
        $this->btnDeleteEmailTemplateContentBlock->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteEmailTemplateContentBlock->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailTemplateContentBlock->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailTemplateContentBlock_Clicked'));

        $this->btnCancelEmailTemplateContentBlock = new QButton($this);
        $this->btnCancelEmailTemplateContentBlock->Text = 'Cancel';
        $this->btnCancelEmailTemplateContentBlock->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelEmailTemplateContentBlock->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEmailTemplateContentBlock_Clicked'));
    }
    protected function btnSaveEmailTemplateContentBlock_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentBlockInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteEmailTemplateContentBlock_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentBlockInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
EmailTemplateContentBlock_DetailForm::Run('EmailTemplateContentBlock_DetailForm');
?>