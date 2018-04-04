<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/SummernoteEntry/SummernoteEntryController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class SummernoteEntry_DetailForm extends QForm {
    // SummernoteEntry Object variables
    protected $SummernoteEntryInstance;
    protected $btnSaveSummernoteEntry,$btnDeleteSummernoteEntry,$btnCancelSummernoteEntry;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitSummernoteEntryInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = SummernoteEntry::Load($objId);
            if ($theObject) {
                $this->SummernoteEntryInstance->setObject($theObject);
                $this->SummernoteEntryInstance->setValues($theObject);
                $this->SummernoteEntryInstance->refreshAll();
                $this->btnDeleteSummernoteEntry->Visible = true;
            } else {
                $this->SummernoteEntryInstance->setObject(null);
                $this->SummernoteEntryInstance->setValues(null);
                $this->btnDeleteSummernoteEntry->Visible = false;
            }
        } else {
            $this->SummernoteEntryInstance->setObject(null);
            $this->SummernoteEntryInstance->setValues(null);
            $this->btnDeleteSummernoteEntry->Visible = false;
        }
    }
    protected function InitSummernoteEntryInstance() {
        $this->SummernoteEntryInstance = new SummernoteEntryController($this);

        $this->btnSaveSummernoteEntry = new QButton($this);
        $this->btnSaveSummernoteEntry->Text = 'Save';
        $this->btnSaveSummernoteEntry->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnSaveSummernoteEntry_Clicked'));

        $this->btnDeleteSummernoteEntry = new QButton($this);
        $this->btnDeleteSummernoteEntry->Text = 'Delete';
        $this->btnDeleteSummernoteEntry->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteSummernoteEntry->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteSummernoteEntry_Clicked'));

        $this->btnCancelSummernoteEntry = new QButton($this);
        $this->btnCancelSummernoteEntry->Text = 'Cancel';
        $this->btnCancelSummernoteEntry->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnCancelSummernoteEntry_Clicked'));
    }
    protected function btnSaveSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
SummernoteEntry_DetailForm::Run('SummernoteEntry_DetailForm');
?>