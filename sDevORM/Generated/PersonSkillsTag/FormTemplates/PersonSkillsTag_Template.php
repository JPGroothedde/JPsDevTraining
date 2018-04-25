<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/PersonSkillsTag/PersonSkillsTagController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonSkillsTag_DetailForm extends QForm {
    // PersonSkillsTag Object variables
    protected $PersonSkillsTagInstance;
    protected $btnSavePersonSkillsTag,$btnDeletePersonSkillsTag,$btnCancelPersonSkillsTag;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonSkillsTagInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PersonSkillsTag::Load($objId);
            if ($theObject) {
                $this->PersonSkillsTagInstance->setObject($theObject);
                $this->PersonSkillsTagInstance->setValues($theObject);
                $this->PersonSkillsTagInstance->refreshAll();
                $this->btnDeletePersonSkillsTag->Visible = true;
            } else {
                $this->PersonSkillsTagInstance->setObject(null);
                $this->PersonSkillsTagInstance->setValues(null);
                $this->btnDeletePersonSkillsTag->Visible = false;
            }
        } else {
            $this->PersonSkillsTagInstance->setObject(null);
            $this->PersonSkillsTagInstance->setValues(null);
            $this->btnDeletePersonSkillsTag->Visible = false;
        }
    }
    protected function InitPersonSkillsTagInstance() {
        $this->PersonSkillsTagInstance = new PersonSkillsTagController($this);

        $this->btnSavePersonSkillsTag = new QButton($this);
        $this->btnSavePersonSkillsTag->Text = 'Save';
        $this->btnSavePersonSkillsTag->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonSkillsTag_Clicked'));

        $this->btnDeletePersonSkillsTag = new QButton($this);
        $this->btnDeletePersonSkillsTag->Text = 'Delete';
        $this->btnDeletePersonSkillsTag->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePersonSkillsTag->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonSkillsTag_Clicked'));

        $this->btnCancelPersonSkillsTag = new QButton($this);
        $this->btnCancelPersonSkillsTag->Text = 'Cancel';
        $this->btnCancelPersonSkillsTag->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPersonSkillsTag_Clicked'));
    }
    protected function btnSavePersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonSkillsTagInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeletePersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonSkillsTagInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
PersonSkillsTag_DetailForm::Run('PersonSkillsTag_DetailForm');
?>