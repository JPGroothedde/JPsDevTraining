<?php
require('../../../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PasswordReset/PasswordResetController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PasswordReset_DetailForm extends QForm {
    // PasswordReset Object variables
    protected $PasswordResetInstance;
    protected $btnSavePasswordReset,$btnDeletePasswordReset,$btnCancelPasswordReset;

    //Mobile detection
    protected $deviceType;
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        $detect = new Mobile_Detect;
        $this->deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        if ($this->deviceType == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPasswordResetInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PasswordReset::Load($objId);
            if ($theObject) {
                $this->PasswordResetInstance->setObject($theObject);
                $this->PasswordResetInstance->setValues($theObject);
                $this->PasswordResetInstance->refreshAll();
                $this->btnDeletePasswordReset->Visible = true;
            } else {
                $this->PasswordResetInstance->setObject(null);
                $this->PasswordResetInstance->setValues(null);
                $this->btnDeletePasswordReset->Visible = false;
            }
        } else {
            $this->PasswordResetInstance->setObject(null);
            $this->PasswordResetInstance->setValues(null);
            $this->btnDeletePasswordReset->Visible = false;
        }
    }
    protected function InitPasswordResetInstance() {
        $this->PasswordResetInstance = new PasswordResetController($this);

        $this->btnSavePasswordReset = new QButton($this);
        $this->btnSavePasswordReset->Text = 'Save PasswordReset';
        $this->btnSavePasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnSavePasswordReset_Clicked'));

        $this->btnDeletePasswordReset = new QButton($this);
        $this->btnDeletePasswordReset->Text = 'Delete PasswordReset';
        $this->btnDeletePasswordReset->CssClass = 'btn btn-danger';
        $this->btnDeletePasswordReset->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePasswordReset_Clicked'));

        $this->btnCancelPasswordReset = new QButton($this);
        $this->btnCancelPasswordReset->Text = 'Cancel';
        $this->btnCancelPasswordReset->CssClass = 'btn btn-default';
        $this->btnCancelPasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPasswordReset_Clicked'));
    }
    protected function btnSavePasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PasswordResetInstance->saveObject()) {
            QApplication::ShowNotedFeedback('Saved!');
        } else
            QApplication::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeletePasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PasswordResetInstance->deleteObject()) {
            QApplication::ShowNotedFeedback('Deleted!');
        } else
            QApplication::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
}
PasswordReset_DetailForm::Run('PasswordReset_DetailForm');
?>