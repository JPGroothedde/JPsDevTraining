<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/Education/EducationController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Education_DetailForm extends QForm {
    // Education Object variables
    protected $EducationInstance;
    protected $btnSaveEducation,$btnDeleteEducation,$btnCancelEducation;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEducationInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Education::Load($objId);
            if ($theObject) {
                $this->EducationInstance->setObject($theObject);
                $this->EducationInstance->setValues($theObject);
                $this->EducationInstance->refreshAll();
                $this->btnDeleteEducation->Visible = true;
            } else {
                $this->EducationInstance->setObject(null);
                $this->EducationInstance->setValues(null);
                $this->btnDeleteEducation->Visible = false;
            }
        } else {
            $this->EducationInstance->setObject(null);
            $this->EducationInstance->setValues(null);
            $this->btnDeleteEducation->Visible = false;
        }
    }
    protected function InitEducationInstance() {
        $this->EducationInstance = new EducationController($this);

        $this->btnSaveEducation = new QButton($this);
        $this->btnSaveEducation->Text = 'Save';
        $this->btnSaveEducation->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveEducation->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEducation_Clicked'));

        $this->btnDeleteEducation = new QButton($this);
        $this->btnDeleteEducation->Text = 'Delete';
        $this->btnDeleteEducation->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteEducation->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEducation->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEducation_Clicked'));

        $this->btnCancelEducation = new QButton($this);
        $this->btnCancelEducation->Text = 'Cancel';
        $this->btnCancelEducation->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelEducation->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEducation_Clicked'));
    }
    protected function btnSaveEducation_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EducationInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteEducation_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EducationInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
Education_DetailForm::Run('Education_DetailForm');
?>