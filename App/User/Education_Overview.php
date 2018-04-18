<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Education/EducationController.php');
require(__SDEV_CONTROLS__.'/Implementations/Education/EducationDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Education_OverviewForm extends QForm {
    // Data grid variables
    protected $EducationGrid;
    protected $EducationWaitControlIcon;
    protected $btnNewEducation;
    protected $selectedEducationId = -1;

    // Education Object variables
    protected $EducationInstance;
    protected $btnSaveEducation,$btnDeleteEducation;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEducationDataGrid();
        $this->InitEducationModal();
    }
    protected function InitEducationModal() {
        $this->EducationInstance = new EducationController($this);

        $this->btnSaveEducation = new QButton($this);
        $this->btnSaveEducation->Text = 'Save';
        $this->btnSaveEducation->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveEducation->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEducation_Clicked'));

        $this->btnDeleteEducation = new QButton($this);
        $this->btnDeleteEducation->Text = 'Delete';
        $this->btnDeleteEducation->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteEducation->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEducation->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEducation_Clicked'));
    }
    protected function btnSaveEducation_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EducationInstance->saveObject()) {
            $this->EducationGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EducationModal');
        }
    }
    protected function btnDeleteEducation_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EducationInstance->deleteObject()) {
            $this->EducationGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EducationModal');
        }
    }
    protected function InitEducationDataGrid() {
        $searchableAttributes = array(QQN::Education()->Institution,QQN::Education()->StartDate,QQN::Education()->EndDate,QQN::Education()->Qualification,QQN::Education()->PersonObject->Id,QQN::Education()->FileDocumentObject->Id);
        $headerItems = array('Institution','Start Date','End Date','Qualification','Person Object','File Document Object');
        $headerSortNodes = array(QQN::Education()->Institution,QQN::Education()->StartDate,QQN::Education()->EndDate,QQN::Education()->Qualification,QQN::Education()->PersonObject->Id,QQN::Education()->FileDocumentObject->Id);
        $columnItems = array('Institution','StartDate','EndDate','Qualification','Person','FileDocument');
        $this->EducationWaitControlIcon = new QWaitIcon($this);
        $this->btnNewEducation = new QButton($this);
        $this->btnNewEducation->Text = 'Add Education';
        $this->btnNewEducation->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewEducation->AddAction(new QClickEvent(), new QAjaxAction('btnNewEducation_Clicked'));
        $this->EducationGrid = new EducationDataGrid($this, QQN::Education(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->EducationWaitControlIcon, 'EducationGrid');
    }
    protected function EducationGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EducationGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EducationGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EducationGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EducationGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EducationGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EducationGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EducationGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EducationGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->EducationGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EducationGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEducationId = $strParameter;
        $theObject = Education::Load($this->selectedEducationId);
        if ($theObject) {
            $this->EducationInstance->setObject($theObject);
            $this->EducationInstance->setValues($theObject);
            $this->EducationInstance->refreshAll();
            $this->btnDeleteEducation->Visible = true;
            AppSpecificFunctions::ToggleModal('EducationModal');
        }
    }
    protected function btnNewEducation_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEducationId = -1;
        $this->EducationInstance->setObject(null);
        $this->EducationInstance->setValues(null);
        $this->btnDeleteEducation->Visible = false;
        AppSpecificFunctions::ToggleModal('EducationModal');
    }
}
Education_OverviewForm::Run('Education_OverviewForm');
?>