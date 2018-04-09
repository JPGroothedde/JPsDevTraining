<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Subscription/SubscriptionController.php');
require(__SDEV_CONTROLS__.'/Implementations/Subscription/SubscriptionDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Subscription_ListForm extends QForm {
    // Data list variables
    protected $SubscriptionList;
    protected $btnNewSubscription;

    // Subscription Object variables
    protected $SubscriptionInstance;
    protected $btnSaveSubscription,$btnDeleteSubscription;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitSubscriptionDataList();
        $this->InitSubscriptionModal();
    }
    protected function InitSubscriptionModal() {
        $this->SubscriptionInstance = new SubscriptionController($this);

        $this->btnSaveSubscription = new QButton($this);
        $this->btnSaveSubscription->Text = 'Save';
        $this->btnSaveSubscription->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveSubscription->AddAction(new QClickEvent(), new QAjaxAction('btnSaveSubscription_Clicked'));

        $this->btnDeleteSubscription = new QButton($this);
        $this->btnDeleteSubscription->Text = 'Delete';
        $this->btnDeleteSubscription->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteSubscription->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteSubscription->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteSubscription_Clicked'));
    }
    protected function btnSaveSubscription_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SubscriptionInstance->saveObject()) {
            $this->SubscriptionList->refreshList();
            AppSpecificFunctions::ToggleModal('SubscriptionModal');
        }
    }
    protected function btnDeleteSubscription_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SubscriptionInstance->deleteObject()) {
            $this->SubscriptionList->refreshList();
            AppSpecificFunctions::ToggleModal('SubscriptionModal');
        }
    }
    protected function InitSubscriptionDataList() {
        $searchableAttributes = array(QQN::Subscription()->StartDate,QQN::Subscription()->EndDate,QQN::Subscription()->AverageMark,QQN::Subscription()->StudentObject->Id,QQN::Subscription()->CourseObject->Id);
        $SortAttributesShown = array('Start Date','End Date','Average Mark','Student Object','Course Object');
        $SortAttributes = array(QQN::Subscription()->StartDate,QQN::Subscription()->EndDate,QQN::Subscription()->AverageMark,QQN::Subscription()->StudentObject->Id,QQN::Subscription()->CourseObject->Id);
        $columnItems = array('StartDate','EndDate','AverageMark','Student','Course');
        $this->btnNewSubscription = AppSpecificFunctions::getNewActionButton($this,'Add Subscription','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewSubscription_Clicked');
        $this->SubscriptionList = new SubscriptionDataList($this, QQN::Subscription(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Subscription_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->SubscriptionList->getActiveId() != $strParameter)
                $this->SubscriptionList->setActiveId($strParameter);
            else
                $this->SubscriptionList->setActiveId(null);
        $theObject = Subscription::Load($strParameter);
        if ($theObject) {
            $this->SubscriptionInstance->setObject($theObject);
            $this->SubscriptionInstance->setValues($theObject);
            $this->SubscriptionInstance->refreshAll();
            $this->btnDeleteSubscription->Visible = true;
            AppSpecificFunctions::ToggleModal('SubscriptionModal');
        }
    }
    protected function Subscription_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Subscription_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Subscription_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Subscription_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Subscription_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewSubscription_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionList->setActiveId(null);
        $this->SubscriptionInstance->setObject(null);
        $this->SubscriptionInstance->setValues(null);
        $this->btnDeleteSubscription->Visible = false;
        AppSpecificFunctions::ToggleModal('SubscriptionModal');
    }
}
Subscription_ListForm::Run('Subscription_ListForm');
?>