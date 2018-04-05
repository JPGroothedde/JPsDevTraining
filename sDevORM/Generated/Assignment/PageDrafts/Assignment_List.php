<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Assignment/AssignmentController.php');
require(__SDEV_CONTROLS__.'/Implementations/Assignment/AssignmentDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Assignment_ListForm extends QForm {
    // Data list variables
    protected $AssignmentList;
    protected $btnNewAssignment;

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

        $this->InitAssignmentDataList();
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
            $this->AssignmentList->refreshList();
            AppSpecificFunctions::ToggleModal('AssignmentModal');
        }
    }
    protected function btnDeleteAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AssignmentInstance->deleteObject()) {
            $this->AssignmentList->refreshList();
            AppSpecificFunctions::ToggleModal('AssignmentModal');
        }
    }
    protected function InitAssignmentDataList() {
        $searchableAttributes = array(QQN::Assignment()->Name,QQN::Assignment()->Status,QQN::Assignment()->FinalMark);
        $SortAttributesShown = array('Name','Status','Final Mark');
        $SortAttributes = array(QQN::Assignment()->Name,QQN::Assignment()->Status,QQN::Assignment()->FinalMark);
        $columnItems = array('Name','Status','FinalMark');
        $this->btnNewAssignment = AppSpecificFunctions::getNewActionButton($this,'Add Assignment','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewAssignment_Clicked');
        $this->AssignmentList = new AssignmentDataList($this, QQN::Assignment(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Assignment_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->AssignmentList->getActiveId() != $strParameter)
                $this->AssignmentList->setActiveId($strParameter);
            else
                $this->AssignmentList->setActiveId(null);
        $theObject = Assignment::Load($strParameter);
        if ($theObject) {
            $this->AssignmentInstance->setObject($theObject);
            $this->AssignmentInstance->setValues($theObject);
            $this->AssignmentInstance->refreshAll();
            $this->btnDeleteAssignment->Visible = true;
            AppSpecificFunctions::ToggleModal('AssignmentModal');
        }
    }
    protected function Assignment_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->AssignmentList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Assignment_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->AssignmentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Assignment_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->AssignmentList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Assignment_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->AssignmentList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Assignment_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->AssignmentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewAssignment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->AssignmentList->setActiveId(null);
        $this->AssignmentInstance->setObject(null);
        $this->AssignmentInstance->setValues(null);
        $this->btnDeleteAssignment->Visible = false;
        AppSpecificFunctions::ToggleModal('AssignmentModal');
    }
}
Assignment_ListForm::Run('Assignment_ListForm');
?>