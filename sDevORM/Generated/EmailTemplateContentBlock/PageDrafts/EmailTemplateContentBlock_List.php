<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplateContentBlock_ListForm extends QForm {
    // Data list variables
    protected $EmailTemplateContentBlockList;
    protected $btnNewEmailTemplateContentBlock;

    // EmailTemplateContentBlock Object variables
    protected $EmailTemplateContentBlockInstance;
    protected $btnSaveEmailTemplateContentBlock,$btnDeleteEmailTemplateContentBlock;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailTemplateContentBlockDataList();
        $this->InitEmailTemplateContentBlockModal();
    }
    protected function InitEmailTemplateContentBlockModal() {
        $this->EmailTemplateContentBlockInstance = new EmailTemplateContentBlockController($this);

        $this->btnSaveEmailTemplateContentBlock = new QButton($this);
        $this->btnSaveEmailTemplateContentBlock->Text = 'Save';
        $this->btnSaveEmailTemplateContentBlock->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveEmailTemplateContentBlock->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailTemplateContentBlock_Clicked'));

        $this->btnDeleteEmailTemplateContentBlock = new QButton($this);
        $this->btnDeleteEmailTemplateContentBlock->Text = 'Delete';
        $this->btnDeleteEmailTemplateContentBlock->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteEmailTemplateContentBlock->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailTemplateContentBlock->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailTemplateContentBlock_Clicked'));
    }
    protected function btnSaveEmailTemplateContentBlock_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentBlockInstance->saveObject()) {
            $this->EmailTemplateContentBlockList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
        }
    }
    protected function btnDeleteEmailTemplateContentBlock_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentBlockInstance->deleteObject()) {
            $this->EmailTemplateContentBlockList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
        }
    }
    protected function InitEmailTemplateContentBlockDataList() {
        $searchableAttributes = array(QQN::EmailTemplateContentBlock()->ContentBlock,QQN::EmailTemplateContentBlock()->ContentType,QQN::EmailTemplateContentBlock()->Position,QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id);
        $SortAttributesShown = array('Content Block','Content Type','Position','Email Template Content Row Object');
        $SortAttributes = array(QQN::EmailTemplateContentBlock()->ContentBlock,QQN::EmailTemplateContentBlock()->ContentType,QQN::EmailTemplateContentBlock()->Position,QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id);
        $columnItems = array('ContentBlock','ContentType','Position','EmailTemplateContentRow');
        $this->btnNewEmailTemplateContentBlock = AppSpecificFunctions::getNewActionButton($this,'Add EmailTemplateContentBlock','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewEmailTemplateContentBlock_Clicked');
        $this->EmailTemplateContentBlockList = new EmailTemplateContentBlockDataList($this, QQN::EmailTemplateContentBlock(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function EmailTemplateContentBlock_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentBlockList->getActiveId() != $strParameter)
                $this->EmailTemplateContentBlockList->setActiveId($strParameter);
            else
                $this->EmailTemplateContentBlockList->setActiveId(null);
        $theObject = EmailTemplateContentBlock::Load($strParameter);
        if ($theObject) {
            $this->EmailTemplateContentBlockInstance->setObject($theObject);
            $this->EmailTemplateContentBlockInstance->setValues($theObject);
            $this->EmailTemplateContentBlockInstance->refreshAll();
            $this->btnDeleteEmailTemplateContentBlock->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
        }
    }
    protected function EmailTemplateContentBlock_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlock_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlock_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlock_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlock_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewEmailTemplateContentBlock_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockList->setActiveId(null);
        $this->EmailTemplateContentBlockInstance->setObject(null);
        $this->EmailTemplateContentBlockInstance->setValues(null);
        $this->btnDeleteEmailTemplateContentBlock->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
    }
}
EmailTemplateContentBlock_ListForm::Run('EmailTemplateContentBlock_ListForm');
?>