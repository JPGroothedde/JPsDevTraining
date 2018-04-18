<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplateContentRow_OverviewForm extends QForm {
    // Data grid variables
    protected $EmailTemplateContentRowGrid;
    protected $EmailTemplateContentRowWaitControlIcon;
    protected $btnNewEmailTemplateContentRow;
    protected $selectedEmailTemplateContentRowId = -1;

    // EmailTemplateContentRow Object variables
    protected $EmailTemplateContentRowInstance;
    protected $btnSaveEmailTemplateContentRow,$btnDeleteEmailTemplateContentRow;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailTemplateContentRowDataGrid();
        $this->InitEmailTemplateContentRowModal();
    }
    protected function InitEmailTemplateContentRowModal() {
        $this->EmailTemplateContentRowInstance = new EmailTemplateContentRowController($this);

        $this->btnSaveEmailTemplateContentRow = new QButton($this);
        $this->btnSaveEmailTemplateContentRow->Text = 'Save';
        $this->btnSaveEmailTemplateContentRow->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveEmailTemplateContentRow->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailTemplateContentRow_Clicked'));

        $this->btnDeleteEmailTemplateContentRow = new QButton($this);
        $this->btnDeleteEmailTemplateContentRow->Text = 'Delete';
        $this->btnDeleteEmailTemplateContentRow->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteEmailTemplateContentRow->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailTemplateContentRow->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailTemplateContentRow_Clicked'));
    }
    protected function btnSaveEmailTemplateContentRow_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentRowInstance->saveObject()) {
            $this->EmailTemplateContentRowGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
        }
    }
    protected function btnDeleteEmailTemplateContentRow_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentRowInstance->deleteObject()) {
            $this->EmailTemplateContentRowGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
        }
    }
    protected function InitEmailTemplateContentRowDataGrid() {
        $searchableAttributes = array(QQN::EmailTemplateContentRow()->Columns,QQN::EmailTemplateContentRow()->RowOrder,QQN::EmailTemplateContentRow()->EmailTemplateObject->Id);
        $headerItems = array('Columns','Row Order','Email Template Object');
        $headerSortNodes = array(QQN::EmailTemplateContentRow()->Columns,QQN::EmailTemplateContentRow()->RowOrder,QQN::EmailTemplateContentRow()->EmailTemplateObject->Id);
        $columnItems = array('Columns','RowOrder','EmailTemplate');
        $this->EmailTemplateContentRowWaitControlIcon = new QWaitIcon($this);
        $this->btnNewEmailTemplateContentRow = new QButton($this);
        $this->btnNewEmailTemplateContentRow->Text = 'Add EmailTemplateContentRow';
        $this->btnNewEmailTemplateContentRow->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewEmailTemplateContentRow->AddAction(new QClickEvent(), new QAjaxAction('btnNewEmailTemplateContentRow_Clicked'));
        $this->EmailTemplateContentRowGrid = new EmailTemplateContentRowDataGrid($this, QQN::EmailTemplateContentRow(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->EmailTemplateContentRowWaitControlIcon, 'EmailTemplateContentRowGrid');
    }
    protected function EmailTemplateContentRowGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRowGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRowGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRowGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRowGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRowGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailTemplateContentRowId = $strParameter;
        $theObject = EmailTemplateContentRow::Load($this->selectedEmailTemplateContentRowId);
        if ($theObject) {
            $this->EmailTemplateContentRowInstance->setObject($theObject);
            $this->EmailTemplateContentRowInstance->setValues($theObject);
            $this->EmailTemplateContentRowInstance->refreshAll();
            $this->btnDeleteEmailTemplateContentRow->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
        }
    }
    protected function btnNewEmailTemplateContentRow_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailTemplateContentRowId = -1;
        $this->EmailTemplateContentRowInstance->setObject(null);
        $this->EmailTemplateContentRowInstance->setValues(null);
        $this->btnDeleteEmailTemplateContentRow->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
    }
}
EmailTemplateContentRow_OverviewForm::Run('EmailTemplateContentRow_OverviewForm');
?>