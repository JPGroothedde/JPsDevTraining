<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Education/EducationController.php');
require(__SDEV_CONTROLS__.'/Implementations/Education/EducationDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Education_ListForm extends QForm {
    // Data list variables
    protected $EducationList;
    protected $btnNewEducation;

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

        $this->InitEducationDataList();
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
            $this->EducationList->refreshList();
            AppSpecificFunctions::ToggleModal('EducationModal');
        }
    }
    protected function btnDeleteEducation_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EducationInstance->deleteObject()) {
            $this->EducationList->refreshList();
            AppSpecificFunctions::ToggleModal('EducationModal');
        }
    }
    protected function InitEducationDataList() {
        $searchableAttributes = array(QQN::Education()->Institution,QQN::Education()->StartDate,QQN::Education()->EndDate,QQN::Education()->Qualification,QQN::Education()->PersonObject->Id,QQN::Education()->FileDocumentObject->Id);
        $SortAttributesShown = array('Institution','Start Date','End Date','Qualification','Person Object','File Document Object');
        $SortAttributes = array(QQN::Education()->Institution,QQN::Education()->StartDate,QQN::Education()->EndDate,QQN::Education()->Qualification,QQN::Education()->PersonObject->Id,QQN::Education()->FileDocumentObject->Id);
        $columnItems = array('Institution','StartDate','EndDate','Qualification','Person','FileDocument');
        $this->btnNewEducation = AppSpecificFunctions::getNewActionButton($this,'Add Education','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewEducation_Clicked');
        $this->EducationList = new EducationDataList($this, QQN::Education(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Education_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->EducationList->getActiveId() != $strParameter)
                $this->EducationList->setActiveId($strParameter);
            else
                $this->EducationList->setActiveId(null);
        $theObject = Education::Load($strParameter);
        if ($theObject) {
            $this->EducationInstance->setObject($theObject);
            $this->EducationInstance->setValues($theObject);
            $this->EducationInstance->refreshAll();
            $this->btnDeleteEducation->Visible = true;
            AppSpecificFunctions::ToggleModal('EducationModal');
        }
    }
    protected function Education_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->EducationList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Education_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->EducationList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Education_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->EducationList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Education_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->EducationList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Education_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->EducationList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewEducation_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EducationList->setActiveId(null);
        $this->EducationInstance->setObject(null);
        $this->EducationInstance->setValues(null);
        $this->btnDeleteEducation->Visible = false;
        AppSpecificFunctions::ToggleModal('EducationModal');
    }
}
Education_ListForm::Run('Education_ListForm');
?>