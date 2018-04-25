<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PersonSkillsTag/PersonSkillsTagController.php');
require(__SDEV_CONTROLS__.'/Implementations/PersonSkillsTag/PersonSkillsTagDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonSkillsTag_OverviewForm extends QForm {
    // Data grid variables
    protected $PersonSkillsTagGrid;
    protected $PersonSkillsTagWaitControlIcon;
    protected $btnNewPersonSkillsTag;
    protected $selectedPersonSkillsTagId = -1;

    // PersonSkillsTag Object variables
    protected $PersonSkillsTagInstance;
    protected $btnSavePersonSkillsTag,$btnDeletePersonSkillsTag;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonSkillsTagDataGrid();
        $this->InitPersonSkillsTagModal();
    }
    protected function InitPersonSkillsTagModal() {
        $this->PersonSkillsTagInstance = new PersonSkillsTagController($this);

        $this->btnSavePersonSkillsTag = new QButton($this);
        $this->btnSavePersonSkillsTag->Text = 'Save';
        $this->btnSavePersonSkillsTag->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonSkillsTag_Clicked'));

        $this->btnDeletePersonSkillsTag = new QButton($this);
        $this->btnDeletePersonSkillsTag->Text = 'Delete';
        $this->btnDeletePersonSkillsTag->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePersonSkillsTag->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonSkillsTag_Clicked'));
    }
    protected function btnSavePersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonSkillsTagInstance->saveObject()) {
            $this->PersonSkillsTagGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
        }
    }
    protected function btnDeletePersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonSkillsTagInstance->deleteObject()) {
            $this->PersonSkillsTagGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
        }
    }
    protected function InitPersonSkillsTagDataGrid() {
        $searchableAttributes = array(QQN::PersonSkillsTag()->SkillTag,QQN::PersonSkillsTag()->PersonObject->Id);
        $headerItems = array('Skill Tag','Person Object');
        $headerSortNodes = array(QQN::PersonSkillsTag()->SkillTag,QQN::PersonSkillsTag()->PersonObject->Id);
        $columnItems = array('SkillTag','Person');
        $this->PersonSkillsTagWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPersonSkillsTag = new QButton($this);
        $this->btnNewPersonSkillsTag->Text = 'Add PersonSkillsTag';
        $this->btnNewPersonSkillsTag->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnNewPersonSkillsTag_Clicked'));
        $this->PersonSkillsTagGrid = new PersonSkillsTagDataGrid($this, QQN::PersonSkillsTag(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PersonSkillsTagWaitControlIcon, 'PersonSkillsTagGrid');
    }
    protected function PersonSkillsTagGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTagGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTagGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTagGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTagGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTagGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonSkillsTagId = $strParameter;
        $theObject = PersonSkillsTag::Load($this->selectedPersonSkillsTagId);
        if ($theObject) {
            $this->PersonSkillsTagInstance->setObject($theObject);
            $this->PersonSkillsTagInstance->setValues($theObject);
            $this->PersonSkillsTagInstance->refreshAll();
            $this->btnDeletePersonSkillsTag->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
        }
    }
    protected function btnNewPersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonSkillsTagId = -1;
        $this->PersonSkillsTagInstance->setObject(null);
        $this->PersonSkillsTagInstance->setValues(null);
        $this->btnDeletePersonSkillsTag->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
    }
}
PersonSkillsTag_OverviewForm::Run('PersonSkillsTag_OverviewForm');
?>