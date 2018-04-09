<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Subscription/SubscriptionController.php');
require(__SDEV_CONTROLS__.'/Implementations/Subscription/SubscriptionDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Subscription_OverviewForm extends QForm {
    // Data grid variables
    protected $SubscriptionGrid;
    protected $SubscriptionWaitControlIcon;
    protected $btnNewSubscription;
    protected $selectedSubscriptionId = -1;

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

        $this->InitSubscriptionDataGrid();
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
            $this->SubscriptionGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('SubscriptionModal');
        }
    }
    protected function btnDeleteSubscription_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SubscriptionInstance->deleteObject()) {
            $this->SubscriptionGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('SubscriptionModal');
        }
    }
    protected function InitSubscriptionDataGrid() {
        $searchableAttributes = array(QQN::Subscription()->StartDate,QQN::Subscription()->EndDate,QQN::Subscription()->AverageMark,QQN::Subscription()->StudentObject->Id,QQN::Subscription()->CourseObject->Id);
        $headerItems = array('Start Date','End Date','Average Mark','Student Object','Course Object');
        $headerSortNodes = array(QQN::Subscription()->StartDate,QQN::Subscription()->EndDate,QQN::Subscription()->AverageMark,QQN::Subscription()->StudentObject->Id,QQN::Subscription()->CourseObject->Id);
        $columnItems = array('StartDate','EndDate','AverageMark','Student','Course');
        $this->SubscriptionWaitControlIcon = new QWaitIcon($this);
        $this->btnNewSubscription = new QButton($this);
        $this->btnNewSubscription->Text = 'Add Subscription';
        $this->btnNewSubscription->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewSubscription->AddAction(new QClickEvent(), new QAjaxAction('btnNewSubscription_Clicked'));
        $this->SubscriptionGrid = new SubscriptionDataGrid($this, QQN::Subscription(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->SubscriptionWaitControlIcon, 'SubscriptionGrid');
    }
    protected function SubscriptionGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SubscriptionGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SubscriptionGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SubscriptionGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function SubscriptionGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->SubscriptionGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function SubscriptionGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedSubscriptionId = $strParameter;
        $theObject = Subscription::Load($this->selectedSubscriptionId);
        if ($theObject) {
            $this->SubscriptionInstance->setObject($theObject);
            $this->SubscriptionInstance->setValues($theObject);
            $this->SubscriptionInstance->refreshAll();
            $this->btnDeleteSubscription->Visible = true;
            AppSpecificFunctions::ToggleModal('SubscriptionModal');
        }
    }
    protected function btnNewSubscription_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedSubscriptionId = -1;
        $this->SubscriptionInstance->setObject(null);
        $this->SubscriptionInstance->setValues(null);
        $this->btnDeleteSubscription->Visible = false;
        AppSpecificFunctions::ToggleModal('SubscriptionModal');
    }
}
Subscription_OverviewForm::Run('Subscription_OverviewForm');
?>