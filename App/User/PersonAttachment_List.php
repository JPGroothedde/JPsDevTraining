<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PersonAttachment/PersonAttachmentController.php');
require(__SDEV_CONTROLS__.'/Implementations/PersonAttachment/PersonAttachmentDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonAttachment_ListForm extends QForm {
    // Data list variables
    protected $PersonAttachmentList;
    protected $btnNewPersonAttachment;

    // PersonAttachment Object variables
    protected $PersonAttachmentInstance;
    protected $btnSavePersonAttachment,$btnDeletePersonAttachment;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonAttachmentDataList();
        $this->InitPersonAttachmentModal();
    }
    protected function InitPersonAttachmentModal() {
        $this->PersonAttachmentInstance = new PersonAttachmentController($this);

        $this->btnSavePersonAttachment = new QButton($this);
        $this->btnSavePersonAttachment->Text = 'Save';
        $this->btnSavePersonAttachment->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonAttachment_Clicked'));

        $this->btnDeletePersonAttachment = new QButton($this);
        $this->btnDeletePersonAttachment->Text = 'Delete';
        $this->btnDeletePersonAttachment->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePersonAttachment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonAttachment_Clicked'));
    }
    protected function btnSavePersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonAttachmentInstance->saveObject()) {
            $this->PersonAttachmentList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
        }
    }
    protected function btnDeletePersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonAttachmentInstance->deleteObject()) {
            $this->PersonAttachmentList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
        }
    }
    protected function InitPersonAttachmentDataList() {
        $searchableAttributes = array(QQN::PersonAttachment()->Name,QQN::PersonAttachment()->PersonObject->Id,QQN::PersonAttachment()->FileDocumentObject->Id);
        $SortAttributesShown = array('Name','Person Object','File Document Object');
        $SortAttributes = array(QQN::PersonAttachment()->Name,QQN::PersonAttachment()->PersonObject->Id,QQN::PersonAttachment()->FileDocumentObject->Id);
        $columnItems = array('Name','Person','FileDocument');
        $this->btnNewPersonAttachment = AppSpecificFunctions::getNewActionButton($this,'Add PersonAttachment','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPersonAttachment_Clicked');
        $this->PersonAttachmentList = new PersonAttachmentDataList($this, QQN::PersonAttachment(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PersonAttachment_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonAttachmentList->getActiveId() != $strParameter)
                $this->PersonAttachmentList->setActiveId($strParameter);
            else
                $this->PersonAttachmentList->setActiveId(null);
        $theObject = PersonAttachment::Load($strParameter);
        if ($theObject) {
            $this->PersonAttachmentInstance->setObject($theObject);
            $this->PersonAttachmentInstance->setValues($theObject);
            $this->PersonAttachmentInstance->refreshAll();
            $this->btnDeletePersonAttachment->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
        }
    }
    protected function PersonAttachment_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachment_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachment_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachment_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonAttachment_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPersonAttachment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonAttachmentList->setActiveId(null);
        $this->PersonAttachmentInstance->setObject(null);
        $this->PersonAttachmentInstance->setValues(null);
        $this->btnDeletePersonAttachment->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonAttachmentModal');
    }
}
PersonAttachment_ListForm::Run('PersonAttachment_ListForm');
?>