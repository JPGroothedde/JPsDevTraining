<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/FileDocument/FileDocumentController.php');
require(__SDEV_CONTROLS__.'/Implementations/FileDocument/FileDocumentDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class FileDocument_OverviewForm extends QForm {
    // Data grid variables
    protected $FileDocumentGrid;
    protected $FileDocumentWaitControlIcon;
    protected $btnNewFileDocument;
    protected $selectedFileDocumentId = -1;

    // FileDocument Object variables
    protected $FileDocumentInstance;
    protected $btnSaveFileDocument,$btnDeleteFileDocument;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitFileDocumentDataGrid();
        $this->InitFileDocumentModal();
    }
    protected function InitFileDocumentModal() {
        $this->FileDocumentInstance = new FileDocumentController($this);

        $this->btnSaveFileDocument = new QButton($this);
        $this->btnSaveFileDocument->Text = 'Save';
        $this->btnSaveFileDocument->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveFileDocument->AddAction(new QClickEvent(), new QAjaxAction('btnSaveFileDocument_Clicked'));

        $this->btnDeleteFileDocument = new QButton($this);
        $this->btnDeleteFileDocument->Text = 'Delete';
        $this->btnDeleteFileDocument->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteFileDocument->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteFileDocument->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteFileDocument_Clicked'));
    }
    protected function btnSaveFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->FileDocumentInstance->saveObject()) {
            $this->FileDocumentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('FileDocumentModal');
        }
    }
    protected function btnDeleteFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->FileDocumentInstance->deleteObject()) {
            $this->FileDocumentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('FileDocumentModal');
        }
    }
    protected function InitFileDocumentDataGrid() {
        $searchableAttributes = array(QQN::FileDocument()->FileName,QQN::FileDocument()->Path,QQN::FileDocument()->CreatedDate);
        $headerItems = array('File Name','Path','Created Date');
        $headerSortNodes = array(QQN::FileDocument()->FileName,QQN::FileDocument()->Path,QQN::FileDocument()->CreatedDate);
        $columnItems = array('FileName','Path','CreatedDate');
        $this->FileDocumentWaitControlIcon = new QWaitIcon($this);
        $this->btnNewFileDocument = new QButton($this);
        $this->btnNewFileDocument->Text = 'Add FileDocument';
        $this->btnNewFileDocument->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewFileDocument->AddAction(new QClickEvent(), new QAjaxAction('btnNewFileDocument_Clicked'));
        $this->FileDocumentGrid = new FileDocumentDataGrid($this, QQN::FileDocument(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->FileDocumentWaitControlIcon, 'FileDocumentGrid');
    }
    protected function FileDocumentGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocumentGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocumentGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocumentGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocumentGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocumentGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedFileDocumentId = $strParameter;
        $theObject = FileDocument::Load($this->selectedFileDocumentId);
        if ($theObject) {
            $this->FileDocumentInstance->setObject($theObject);
            $this->FileDocumentInstance->setValues($theObject);
            $this->FileDocumentInstance->refreshAll();
            $this->btnDeleteFileDocument->Visible = true;
            AppSpecificFunctions::ToggleModal('FileDocumentModal');
        }
    }
    protected function btnNewFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedFileDocumentId = -1;
        $this->FileDocumentInstance->setObject(null);
        $this->FileDocumentInstance->setValues(null);
        $this->btnDeleteFileDocument->Visible = false;
        AppSpecificFunctions::ToggleModal('FileDocumentModal');
    }
}
FileDocument_OverviewForm::Run('FileDocument_OverviewForm');
?>