<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/FileDocument/FileDocumentController.php');
require(__SDEV_CONTROLS__.'/Implementations/FileDocument/FileDocumentDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class FileDocument_ListForm extends QForm {
    // Data list variables
    protected $FileDocumentList;
    protected $btnNewFileDocument;

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

        $this->InitFileDocumentDataList();
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
            $this->FileDocumentList->refreshList();
            AppSpecificFunctions::ToggleModal('FileDocumentModal');
        }
    }
    protected function btnDeleteFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->FileDocumentInstance->deleteObject()) {
            $this->FileDocumentList->refreshList();
            AppSpecificFunctions::ToggleModal('FileDocumentModal');
        }
    }
    protected function InitFileDocumentDataList() {
        $searchableAttributes = array(QQN::FileDocument()->FileName,QQN::FileDocument()->Path,QQN::FileDocument()->CreatedDate);
        $SortAttributesShown = array('File Name','Path','Created Date');
        $SortAttributes = array(QQN::FileDocument()->FileName,QQN::FileDocument()->Path,QQN::FileDocument()->CreatedDate);
        $columnItems = array('FileName','Path','CreatedDate');
        $this->btnNewFileDocument = AppSpecificFunctions::getNewActionButton($this,'Add FileDocument','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewFileDocument_Clicked');
        $this->FileDocumentList = new FileDocumentDataList($this, QQN::FileDocument(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function FileDocument_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->FileDocumentList->getActiveId() != $strParameter)
                $this->FileDocumentList->setActiveId($strParameter);
            else
                $this->FileDocumentList->setActiveId(null);
        $theObject = FileDocument::Load($strParameter);
        if ($theObject) {
            $this->FileDocumentInstance->setObject($theObject);
            $this->FileDocumentInstance->setValues($theObject);
            $this->FileDocumentInstance->refreshAll();
            $this->btnDeleteFileDocument->Visible = true;
            AppSpecificFunctions::ToggleModal('FileDocumentModal');
        }
    }
    protected function FileDocument_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocument_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocument_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocument_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function FileDocument_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewFileDocument_Clicked($strFormId, $strControlId, $strParameter) {
        $this->FileDocumentList->setActiveId(null);
        $this->FileDocumentInstance->setObject(null);
        $this->FileDocumentInstance->setValues(null);
        $this->btnDeleteFileDocument->Visible = false;
        AppSpecificFunctions::ToggleModal('FileDocumentModal');
    }
}
FileDocument_ListForm::Run('FileDocument_ListForm');
?>