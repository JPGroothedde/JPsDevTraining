<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ProfilePicture/ProfilePictureController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ProfilePicture_DetailForm extends QForm {
    // ProfilePicture Object variables
    protected $ProfilePictureInstance;
    protected $btnSaveProfilePicture,$btnDeleteProfilePicture,$btnCancelProfilePicture;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitProfilePictureInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = ProfilePicture::Load($objId);
            if ($theObject) {
                $this->ProfilePictureInstance->setObject($theObject);
                $this->ProfilePictureInstance->setValues($theObject);
                $this->ProfilePictureInstance->refreshAll();
                $this->btnDeleteProfilePicture->Visible = true;
            } else {
                $this->ProfilePictureInstance->setObject(null);
                $this->ProfilePictureInstance->setValues(null);
                $this->btnDeleteProfilePicture->Visible = false;
            }
        } else {
            $this->ProfilePictureInstance->setObject(null);
            $this->ProfilePictureInstance->setValues(null);
            $this->btnDeleteProfilePicture->Visible = false;
        }
    }
    protected function InitProfilePictureInstance() {
        $this->ProfilePictureInstance = new ProfilePictureController($this);

        $this->btnSaveProfilePicture = new QButton($this);
        $this->btnSaveProfilePicture->Text = 'Save';
        $this->btnSaveProfilePicture->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveProfilePicture->AddAction(new QClickEvent(), new QAjaxAction('btnSaveProfilePicture_Clicked'));

        $this->btnDeleteProfilePicture = new QButton($this);
        $this->btnDeleteProfilePicture->Text = 'Delete';
        $this->btnDeleteProfilePicture->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteProfilePicture->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteProfilePicture->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteProfilePicture_Clicked'));

        $this->btnCancelProfilePicture = new QButton($this);
        $this->btnCancelProfilePicture->Text = 'Cancel';
        $this->btnCancelProfilePicture->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelProfilePicture->AddAction(new QClickEvent(), new QAjaxAction('btnCancelProfilePicture_Clicked'));
    }
    protected function btnSaveProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProfilePictureInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProfilePictureInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
ProfilePicture_DetailForm::Run('ProfilePicture_DetailForm');
?>