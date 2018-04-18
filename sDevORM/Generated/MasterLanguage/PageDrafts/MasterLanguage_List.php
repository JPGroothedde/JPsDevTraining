<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/MasterLanguage/MasterLanguageController.php');
require(__SDEV_CONTROLS__.'/Implementations/MasterLanguage/MasterLanguageDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class MasterLanguage_ListForm extends QForm {
    // Data list variables
    protected $MasterLanguageList;
    protected $btnNewMasterLanguage;

    // MasterLanguage Object variables
    protected $MasterLanguageInstance;
    protected $btnSaveMasterLanguage,$btnDeleteMasterLanguage;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitMasterLanguageDataList();
        $this->InitMasterLanguageModal();
    }
    protected function InitMasterLanguageModal() {
        $this->MasterLanguageInstance = new MasterLanguageController($this);

        $this->btnSaveMasterLanguage = new QButton($this);
        $this->btnSaveMasterLanguage->Text = 'Save';
        $this->btnSaveMasterLanguage->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveMasterLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnSaveMasterLanguage_Clicked'));

        $this->btnDeleteMasterLanguage = new QButton($this);
        $this->btnDeleteMasterLanguage->Text = 'Delete';
        $this->btnDeleteMasterLanguage->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteMasterLanguage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteMasterLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteMasterLanguage_Clicked'));
    }
    protected function btnSaveMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->MasterLanguageInstance->saveObject()) {
            $this->MasterLanguageList->refreshList();
            AppSpecificFunctions::ToggleModal('MasterLanguageModal');
        }
    }
    protected function btnDeleteMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->MasterLanguageInstance->deleteObject()) {
            $this->MasterLanguageList->refreshList();
            AppSpecificFunctions::ToggleModal('MasterLanguageModal');
        }
    }
    protected function InitMasterLanguageDataList() {
        $searchableAttributes = array(QQN::MasterLanguage()->Language);
        $SortAttributesShown = array('Language');
        $SortAttributes = array(QQN::MasterLanguage()->Language);
        $columnItems = array('Language');
        $this->btnNewMasterLanguage = AppSpecificFunctions::getNewActionButton($this,'Add MasterLanguage','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewMasterLanguage_Clicked');
        $this->MasterLanguageList = new MasterLanguageDataList($this, QQN::MasterLanguage(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function MasterLanguage_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->MasterLanguageList->getActiveId() != $strParameter)
                $this->MasterLanguageList->setActiveId($strParameter);
            else
                $this->MasterLanguageList->setActiveId(null);
        $theObject = MasterLanguage::Load($strParameter);
        if ($theObject) {
            $this->MasterLanguageInstance->setObject($theObject);
            $this->MasterLanguageInstance->setValues($theObject);
            $this->MasterLanguageInstance->refreshAll();
            $this->btnDeleteMasterLanguage->Visible = true;
            AppSpecificFunctions::ToggleModal('MasterLanguageModal');
        }
    }
    protected function MasterLanguage_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguage_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguage_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguage_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguage_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageList->setActiveId(null);
        $this->MasterLanguageInstance->setObject(null);
        $this->MasterLanguageInstance->setValues(null);
        $this->btnDeleteMasterLanguage->Visible = false;
        AppSpecificFunctions::ToggleModal('MasterLanguageModal');
    }
}
MasterLanguage_ListForm::Run('MasterLanguage_ListForm');
?>