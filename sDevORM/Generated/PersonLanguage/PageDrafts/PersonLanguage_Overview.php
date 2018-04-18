<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PersonLanguage/PersonLanguageController.php');
require(__SDEV_CONTROLS__.'/Implementations/PersonLanguage/PersonLanguageDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonLanguage_OverviewForm extends QForm {
    // Data grid variables
    protected $PersonLanguageGrid;
    protected $PersonLanguageWaitControlIcon;
    protected $btnNewPersonLanguage;
    protected $selectedPersonLanguageId = -1;

    // PersonLanguage Object variables
    protected $PersonLanguageInstance;
    protected $btnSavePersonLanguage,$btnDeletePersonLanguage;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonLanguageDataGrid();
        $this->InitPersonLanguageModal();
    }
    protected function InitPersonLanguageModal() {
        $this->PersonLanguageInstance = new PersonLanguageController($this);

        $this->btnSavePersonLanguage = new QButton($this);
        $this->btnSavePersonLanguage->Text = 'Save';
        $this->btnSavePersonLanguage->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonLanguage_Clicked'));

        $this->btnDeletePersonLanguage = new QButton($this);
        $this->btnDeletePersonLanguage->Text = 'Delete';
        $this->btnDeletePersonLanguage->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePersonLanguage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonLanguage_Clicked'));
    }
    protected function btnSavePersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonLanguageInstance->saveObject()) {
            $this->PersonLanguageGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonLanguageModal');
        }
    }
    protected function btnDeletePersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonLanguageInstance->deleteObject()) {
            $this->PersonLanguageGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonLanguageModal');
        }
    }
    protected function InitPersonLanguageDataGrid() {
        $searchableAttributes = array(QQN::PersonLanguage()->Language,QQN::PersonLanguage()->PersonObject->Id,QQN::PersonLanguage()->MasterLanguageObject->Id);
        $headerItems = array('Language','Person Object','Master Language Object');
        $headerSortNodes = array(QQN::PersonLanguage()->Language,QQN::PersonLanguage()->PersonObject->Id,QQN::PersonLanguage()->MasterLanguageObject->Id);
        $columnItems = array('Language','Person','MasterLanguage');
        $this->PersonLanguageWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPersonLanguage = new QButton($this);
        $this->btnNewPersonLanguage->Text = 'Add PersonLanguage';
        $this->btnNewPersonLanguage->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnNewPersonLanguage_Clicked'));
        $this->PersonLanguageGrid = new PersonLanguageDataGrid($this, QQN::PersonLanguage(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PersonLanguageWaitControlIcon, 'PersonLanguageGrid');
    }
    protected function PersonLanguageGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguageGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguageGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguageGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguageGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguageGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonLanguageId = $strParameter;
        $theObject = PersonLanguage::Load($this->selectedPersonLanguageId);
        if ($theObject) {
            $this->PersonLanguageInstance->setObject($theObject);
            $this->PersonLanguageInstance->setValues($theObject);
            $this->PersonLanguageInstance->refreshAll();
            $this->btnDeletePersonLanguage->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonLanguageModal');
        }
    }
    protected function btnNewPersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonLanguageId = -1;
        $this->PersonLanguageInstance->setObject(null);
        $this->PersonLanguageInstance->setValues(null);
        $this->btnDeletePersonLanguage->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonLanguageModal');
    }
}
PersonLanguage_OverviewForm::Run('PersonLanguage_OverviewForm');
?>