<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/MasterLanguage/MasterLanguageController.php');
require(__SDEV_CONTROLS__.'/Implementations/MasterLanguage/MasterLanguageDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class MasterLanguage_OverviewForm extends QForm {
    // Data grid variables
    protected $MasterLanguageGrid;
    protected $MasterLanguageWaitControlIcon;
    protected $btnNewMasterLanguage;
    protected $selectedMasterLanguageId = -1;

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

        $this->InitMasterLanguageDataGrid();
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
            $this->MasterLanguageGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('MasterLanguageModal');
        }
    }
    protected function btnDeleteMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->MasterLanguageInstance->deleteObject()) {
            $this->MasterLanguageGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('MasterLanguageModal');
        }
    }
    protected function InitMasterLanguageDataGrid() {
        $searchableAttributes = array(QQN::MasterLanguage()->Language);
        $headerItems = array('Language');
        $headerSortNodes = array(QQN::MasterLanguage()->Language);
        $columnItems = array('Language');
        $this->MasterLanguageWaitControlIcon = new QWaitIcon($this);
        $this->btnNewMasterLanguage = new QButton($this);
        $this->btnNewMasterLanguage->Text = 'Add MasterLanguage';
        $this->btnNewMasterLanguage->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewMasterLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnNewMasterLanguage_Clicked'));
        $this->MasterLanguageGrid = new MasterLanguageDataGrid($this, QQN::MasterLanguage(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->MasterLanguageWaitControlIcon, 'MasterLanguageGrid');
    }
    protected function MasterLanguageGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguageGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguageGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguageGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguageGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->MasterLanguageGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function MasterLanguageGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedMasterLanguageId = $strParameter;
        $theObject = MasterLanguage::Load($this->selectedMasterLanguageId);
        if ($theObject) {
            $this->MasterLanguageInstance->setObject($theObject);
            $this->MasterLanguageInstance->setValues($theObject);
            $this->MasterLanguageInstance->refreshAll();
            $this->btnDeleteMasterLanguage->Visible = true;
            AppSpecificFunctions::ToggleModal('MasterLanguageModal');
        }
    }
    protected function btnNewMasterLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedMasterLanguageId = -1;
        $this->MasterLanguageInstance->setObject(null);
        $this->MasterLanguageInstance->setValues(null);
        $this->btnDeleteMasterLanguage->Visible = false;
        AppSpecificFunctions::ToggleModal('MasterLanguageModal');
    }
}
MasterLanguage_OverviewForm::Run('MasterLanguage_OverviewForm');
?>