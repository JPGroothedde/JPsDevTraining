<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/Person/PersonController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Person_DetailForm extends QForm {
    // Person Object variables
    protected $PersonInstance;
    protected $btnSavePerson,$btnDeletePerson,$btnCancelPerson;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Person::Load($objId);
            if ($theObject) {
                $this->PersonInstance->setObject($theObject);
                $this->PersonInstance->setValues($theObject);
                $this->PersonInstance->refreshAll();
                $this->btnDeletePerson->Visible = true;
            } else {
                $this->PersonInstance->setObject(null);
                $this->PersonInstance->setValues(null);
                $this->btnDeletePerson->Visible = false;
            }
        } else {
            $this->PersonInstance->setObject(null);
            $this->PersonInstance->setValues(null);
            $this->btnDeletePerson->Visible = false;
        }
    }
    protected function InitPersonInstance() {
        $this->PersonInstance = new PersonController($this);

        $this->btnSavePerson = new QButton($this);
        $this->btnSavePerson->Text = 'Save';
        $this->btnSavePerson->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePerson->AddAction(new QClickEvent(), new QAjaxAction('btnSavePerson_Clicked'));

        $this->btnDeletePerson = new QButton($this);
        $this->btnDeletePerson->Text = 'Delete';
        $this->btnDeletePerson->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePerson->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePerson->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePerson_Clicked'));

        $this->btnCancelPerson = new QButton($this);
        $this->btnCancelPerson->Text = 'Cancel';
        $this->btnCancelPerson->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPerson->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPerson_Clicked'));
    }
    protected function btnSavePerson_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeletePerson_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    protected function btnPhoneVerified_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->PersonInstance->getControlId('PhoneVerified'))->Toggle(!$this->GetControl($this->PersonInstance->getControlId('PhoneVerified'))->IsToggled);
    }

    
    protected function btnIdentityVerified_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->PersonInstance->getControlId('IdentityVerified'))->Toggle(!$this->GetControl($this->PersonInstance->getControlId('IdentityVerified'))->IsToggled);
    }

    
    protected function btnDriversLicenseVerified_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->PersonInstance->getControlId('DriversLicenseVerified'))->Toggle(!$this->GetControl($this->PersonInstance->getControlId('DriversLicenseVerified'))->IsToggled);
    }

    
}
Person_DetailForm::Run('Person_DetailForm');
?>