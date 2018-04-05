<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/Subscription/SubscriptionController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Subscription_DetailForm extends QForm {
    // Subscription Object variables
    protected $SubscriptionInstance;
    protected $btnSaveSubscription,$btnDeleteSubscription,$btnCancelSubscription;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitSubscriptionInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Subscription::Load($objId);
            if ($theObject) {
                $this->SubscriptionInstance->setObject($theObject);
                $this->SubscriptionInstance->setValues($theObject);
                $this->SubscriptionInstance->refreshAll();
                $this->btnDeleteSubscription->Visible = true;
            } else {
                $this->SubscriptionInstance->setObject(null);
                $this->SubscriptionInstance->setValues(null);
                $this->btnDeleteSubscription->Visible = false;
            }
        } else {
            $this->SubscriptionInstance->setObject(null);
            $this->SubscriptionInstance->setValues(null);
            $this->btnDeleteSubscription->Visible = false;
        }
    }
    protected function InitSubscriptionInstance() {
        $this->SubscriptionInstance = new SubscriptionController($this);

        $this->btnSaveSubscription = new QButton($this);
        $this->btnSaveSubscription->Text = 'Save';
        $this->btnSaveSubscription->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveSubscription->AddAction(new QClickEvent(), new QAjaxAction('btnSaveSubscription_Clicked'));

        $this->btnDeleteSubscription = new QButton($this);
        $this->btnDeleteSubscription->Text = 'Delete';
        $this->btnDeleteSubscription->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteSubscription->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteSubscription->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteSubscription_Clicked'));

        $this->btnCancelSubscription = new QButton($this);
        $this->btnCancelSubscription->Text = 'Cancel';
        $this->btnCancelSubscription->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelSubscription->AddAction(new QClickEvent(), new QAjaxAction('btnCancelSubscription_Clicked'));
    }
    protected function btnSaveSubscription_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SubscriptionInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteSubscription_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SubscriptionInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
Subscription_DetailForm::Run('Subscription_DetailForm');
?>