<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Assignment/AssignmentController.php');
require(__SDEV_CONTROLS__.'/Implementations/Assignment/AssignmentDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Assignment_OverviewForm extends QForm {
    // Data grid variables
    protected $AssignmentGrid;
    protected $AssignmentWaitControlIcon;
    protected $btnNewAssignment;
    protected $selectedAssignmentId = -1;

    // Assignment Object variables
    protected $AssignmentInstance;
    protected $btnSaveAssignment,$btnDeleteAssignment;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitAssignmentDataGrid();
        $this->InitAssignmentModal();
    }
    protected function InitAssignmentModal() {
        $this->AssignmentInstance = new AssignmentController($this);

        $this->btnSaveAssignment = new QButton($this);
        $this->btnSaveAssignment->Text = 'Save';
        $this->btnSaveAssignment->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveAssignment->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAssignment_Clicked'));

        $this->btnDeleteAssignment = new QButton($this);
        $this->btnDeleteAssignment->Text = 'Delete';
        $this->btnDeleteAssignment->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteAssignment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAssignment->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAssignment_Clicked'));
    }
    protected function btnSaveAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AssignmentInstance->saveObject()) {
            $this->AssignmentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('AssignmentModal');
        }
    }
    protected function btnDeleteAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AssignmentInstance->deleteObject()) {
            $this->AssignmentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('AssignmentModal');
        }
    }
    protected function InitAssignmentDataGrid() {
        $searchableAttributes = array(QQN::Assignment()->AssignmentName,QQN::Assignment()->Status,QQN::Assignment()->FinalMark,QQN::Assignment()->SubscriptionObject->Id);
        $headerItems = array('Assignment Name','Status','Final Mark','Subscription Object');
        $headerSortNodes = array(QQN::Assignment()->AssignmentName,QQN::Assignment()->Status,QQN::Assignment()->FinalMark,QQN::Assignment()->SubscriptionObject->Id);
        $columnItems = array('AssignmentName','Status','FinalMark','Subscription');
        $this->AssignmentWaitControlIcon = new QWaitIcon($this);
        $this->btnNewAssignment = new QButton($this);
        $this->btnNewAssignment->Text = 'Add Assignment';
        $this->btnNewAssignment->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewAssignment->AddAction(new QClickEvent(), new QAjaxAction('btnNewAssignment_Clicked'));
        $this->AssignmentGrid = new AssignmentDataGrid($this, QQN::Assignment(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->AssignmentWaitControlIcon, 'AssignmentGrid');
    }
    protected function AssignmentGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AssignmentGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AssignmentGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AssignmentGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AssignmentGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AssignmentGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AssignmentGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AssignmentGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function AssignmentGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->AssignmentGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function AssignmentGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedAssignmentId = $strParameter;
        $theObject = Assignment::Load($this->selectedAssignmentId);
        if ($theObject) {
            $this->AssignmentInstance->setObject($theObject);
            $this->AssignmentInstance->setValues($theObject);
            $this->AssignmentInstance->refreshAll();
            $this->btnDeleteAssignment->Visible = true;
            AppSpecificFunctions::ToggleModal('AssignmentModal');
        }
    }
    protected function btnNewAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedAssignmentId = -1;
        $this->AssignmentInstance->setObject(null);
        $this->AssignmentInstance->setValues(null);
        $this->btnDeleteAssignment->Visible = false;
        AppSpecificFunctions::ToggleModal('AssignmentModal');
    }
}
Assignment_OverviewForm::Run('Assignment_OverviewForm');
?>