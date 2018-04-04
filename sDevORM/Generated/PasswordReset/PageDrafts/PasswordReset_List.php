<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PasswordReset/PasswordResetController.php');
require(__SDEV_CONTROLS__.'/Implementations/PasswordReset/PasswordResetDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PasswordReset_ListForm extends QForm {
    // Data list variables
    protected $PasswordResetList;
    protected $btnNewPasswordReset;

    // PasswordReset Object variables
    protected $PasswordResetInstance;
    protected $btnSavePasswordReset,$btnDeletePasswordReset;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPasswordResetDataList();
        $this->InitPasswordResetModal();
    }
    protected function InitPasswordResetModal() {
        $this->PasswordResetInstance = new PasswordResetController($this);

        $this->btnSavePasswordReset = new QButton($this);
        $this->btnSavePasswordReset->Text = 'Save';
        $this->btnSavePasswordReset->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnSavePasswordReset_Clicked'));

        $this->btnDeletePasswordReset = new QButton($this);
        $this->btnDeletePasswordReset->Text = 'Delete';
        $this->btnDeletePasswordReset->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePasswordReset->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePasswordReset->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePasswordReset_Clicked'));
    }
    protected function btnSavePasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PasswordResetInstance->saveObject()) {
            $this->PasswordResetList->refreshList();
            AppSpecificFunctions::ToggleModal('PasswordResetModal');
        }
    }
    protected function btnDeletePasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PasswordResetInstance->deleteObject()) {
            $this->PasswordResetList->refreshList();
            AppSpecificFunctions::ToggleModal('PasswordResetModal');
        }
    }
    protected function InitPasswordResetDataList() {
        $searchableAttributes = array(QQN::PasswordReset()->Token,QQN::PasswordReset()->CreatedDateTime,QQN::PasswordReset()->AccountObject->Id);
        $SortAttributesShown = array('Token','Created Date Time','Account Object');
        $SortAttributes = array(QQN::PasswordReset()->Token,QQN::PasswordReset()->CreatedDateTime,QQN::PasswordReset()->AccountObject->Id);
        $columnItems = array('Token','CreatedDateTime','Account');
        $this->btnNewPasswordReset = AppSpecificFunctions::getNewActionButton($this,'Add PasswordReset','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPasswordReset_Clicked');
        $this->PasswordResetList = new PasswordResetDataList($this, QQN::PasswordReset(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PasswordReset_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PasswordResetList->getActiveId() != $strParameter)
                $this->PasswordResetList->setActiveId($strParameter);
            else
                $this->PasswordResetList->setActiveId(null);
        $theObject = PasswordReset::Load($strParameter);
        if ($theObject) {
            $this->PasswordResetInstance->setObject($theObject);
            $this->PasswordResetInstance->setValues($theObject);
            $this->PasswordResetInstance->refreshAll();
            $this->btnDeletePasswordReset->Visible = true;
            AppSpecificFunctions::ToggleModal('PasswordResetModal');
        }
    }
    protected function PasswordReset_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordReset_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordReset_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordReset_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PasswordReset_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPasswordReset_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PasswordResetList->setActiveId(null);
        $this->PasswordResetInstance->setObject(null);
        $this->PasswordResetInstance->setValues(null);
        $this->btnDeletePasswordReset->Visible = false;
        AppSpecificFunctions::ToggleModal('PasswordResetModal');
    }
}
PasswordReset_ListForm::Run('PasswordReset_ListForm');
?>