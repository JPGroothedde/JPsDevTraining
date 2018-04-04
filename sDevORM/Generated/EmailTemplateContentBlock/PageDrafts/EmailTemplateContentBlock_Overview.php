<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailTemplateContentBlock/EmailTemplateContentBlockDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplateContentBlock_OverviewForm extends QForm {
    // Data grid variables
    protected $EmailTemplateContentBlockGrid;
    protected $EmailTemplateContentBlockWaitControlIcon;
    protected $btnNewEmailTemplateContentBlock;
    protected $selectedEmailTemplateContentBlockId = -1;

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

        $this->InitEmailTemplateContentBlockDataGrid();
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
            $this->EmailTemplateContentBlockGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
        }
    }
    protected function btnDeleteEmailTemplateContentBlock_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentBlockInstance->deleteObject()) {
            $this->EmailTemplateContentBlockGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
        }
    }
    protected function InitEmailTemplateContentBlockDataGrid() {
        $searchableAttributes = array(QQN::EmailTemplateContentBlock()->ContentBlock,QQN::EmailTemplateContentBlock()->ContentType,QQN::EmailTemplateContentBlock()->Position,QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id);
        $headerItems = array('Content Block','Content Type','Position','Email Template Content Row Object');
        $headerSortNodes = array(QQN::EmailTemplateContentBlock()->ContentBlock,QQN::EmailTemplateContentBlock()->ContentType,QQN::EmailTemplateContentBlock()->Position,QQN::EmailTemplateContentBlock()->EmailTemplateContentRowObject->Id);
        $columnItems = array('ContentBlock','ContentType','Position','EmailTemplateContentRow');
        $this->EmailTemplateContentBlockWaitControlIcon = new QWaitIcon($this);
        $this->btnNewEmailTemplateContentBlock = new QButton($this);
        $this->btnNewEmailTemplateContentBlock->Text = 'Add EmailTemplateContentBlock';
        $this->btnNewEmailTemplateContentBlock->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewEmailTemplateContentBlock->AddAction(new QClickEvent(), new QAjaxAction('btnNewEmailTemplateContentBlock_Clicked'));
        $this->EmailTemplateContentBlockGrid = new EmailTemplateContentBlockDataGrid($this, QQN::EmailTemplateContentBlock(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->EmailTemplateContentBlockWaitControlIcon, 'EmailTemplateContentBlockGrid');
    }
    protected function EmailTemplateContentBlockGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlockGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlockGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlockGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlockGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentBlockGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentBlockGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailTemplateContentBlockId = $strParameter;
        $theObject = EmailTemplateContentBlock::Load($this->selectedEmailTemplateContentBlockId);
        if ($theObject) {
            $this->EmailTemplateContentBlockInstance->setObject($theObject);
            $this->EmailTemplateContentBlockInstance->setValues($theObject);
            $this->EmailTemplateContentBlockInstance->refreshAll();
            $this->btnDeleteEmailTemplateContentBlock->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
        }
    }
    protected function btnNewEmailTemplateContentBlock_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailTemplateContentBlockId = -1;
        $this->EmailTemplateContentBlockInstance->setObject(null);
        $this->EmailTemplateContentBlockInstance->setValues(null);
        $this->btnDeleteEmailTemplateContentBlock->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailTemplateContentBlockModal');
    }
}
EmailTemplateContentBlock_OverviewForm::Run('EmailTemplateContentBlock_OverviewForm');
?>