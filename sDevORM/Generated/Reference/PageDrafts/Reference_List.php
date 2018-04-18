<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Reference/ReferenceController.php');
require(__SDEV_CONTROLS__.'/Implementations/Reference/ReferenceDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Reference_ListForm extends QForm {
    // Data list variables
    protected $ReferenceList;
    protected $btnNewReference;

    // Reference Object variables
    protected $ReferenceInstance;
    protected $btnSaveReference,$btnDeleteReference;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitReferenceDataList();
        $this->InitReferenceModal();
    }
    protected function InitReferenceModal() {
        $this->ReferenceInstance = new ReferenceController($this);

        $this->btnSaveReference = new QButton($this);
        $this->btnSaveReference->Text = 'Save';
        $this->btnSaveReference->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveReference->AddAction(new QClickEvent(), new QAjaxAction('btnSaveReference_Clicked'));

        $this->btnDeleteReference = new QButton($this);
        $this->btnDeleteReference->Text = 'Delete';
        $this->btnDeleteReference->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteReference->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteReference->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteReference_Clicked'));
    }
    protected function btnSaveReference_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ReferenceInstance->saveObject()) {
            $this->ReferenceList->refreshList();
            AppSpecificFunctions::ToggleModal('ReferenceModal');
        }
    }
    protected function btnDeleteReference_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ReferenceInstance->deleteObject()) {
            $this->ReferenceList->refreshList();
            AppSpecificFunctions::ToggleModal('ReferenceModal');
        }
    }
    protected function InitReferenceDataList() {
        $searchableAttributes = array(QQN::Reference()->FirstName,QQN::Reference()->Surname,QQN::Reference()->Relationship,QQN::Reference()->TelephoneNumber,QQN::Reference()->PersonObject->Id,QQN::Reference()->FileDocumentObject->Id);
        $SortAttributesShown = array('First Name','Surname','Relationship','Telephone Number','Person Object','File Document Object');
        $SortAttributes = array(QQN::Reference()->FirstName,QQN::Reference()->Surname,QQN::Reference()->Relationship,QQN::Reference()->TelephoneNumber,QQN::Reference()->PersonObject->Id,QQN::Reference()->FileDocumentObject->Id);
        $columnItems = array('FirstName','Surname','Relationship','TelephoneNumber','Person','FileDocument');
        $this->btnNewReference = AppSpecificFunctions::getNewActionButton($this,'Add Reference','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewReference_Clicked');
        $this->ReferenceList = new ReferenceDataList($this, QQN::Reference(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Reference_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->ReferenceList->getActiveId() != $strParameter)
                $this->ReferenceList->setActiveId($strParameter);
            else
                $this->ReferenceList->setActiveId(null);
        $theObject = Reference::Load($strParameter);
        if ($theObject) {
            $this->ReferenceInstance->setObject($theObject);
            $this->ReferenceInstance->setValues($theObject);
            $this->ReferenceInstance->refreshAll();
            $this->btnDeleteReference->Visible = true;
            AppSpecificFunctions::ToggleModal('ReferenceModal');
        }
    }
    protected function Reference_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->ReferenceList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Reference_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->ReferenceList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Reference_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->ReferenceList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Reference_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->ReferenceList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Reference_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->ReferenceList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewReference_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ReferenceList->setActiveId(null);
        $this->ReferenceInstance->setObject(null);
        $this->ReferenceInstance->setValues(null);
        $this->btnDeleteReference->Visible = false;
        AppSpecificFunctions::ToggleModal('ReferenceModal');
    }
}
Reference_ListForm::Run('Reference_ListForm');
?>