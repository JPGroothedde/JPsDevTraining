<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailTemplateContentRow/EmailTemplateContentRowDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailTemplateContentRow_ListForm extends QForm {
    // Data list variables
    protected $EmailTemplateContentRowList;
    protected $btnNewEmailTemplateContentRow;

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

        $this->InitEmailTemplateContentRowDataList();
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
            $this->EmailTemplateContentRowList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
        }
    }
    protected function btnDeleteEmailTemplateContentRow_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentRowInstance->deleteObject()) {
            $this->EmailTemplateContentRowList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
        }
    }
    protected function InitEmailTemplateContentRowDataList() {
        $searchableAttributes = array(QQN::EmailTemplateContentRow()->Columns,QQN::EmailTemplateContentRow()->RowOrder,QQN::EmailTemplateContentRow()->EmailTemplateObject->Id);
        $SortAttributesShown = array('Columns','Row Order','Email Template Object');
        $SortAttributes = array(QQN::EmailTemplateContentRow()->Columns,QQN::EmailTemplateContentRow()->RowOrder,QQN::EmailTemplateContentRow()->EmailTemplateObject->Id);
        $columnItems = array('Columns','RowOrder','EmailTemplate');
        $this->btnNewEmailTemplateContentRow = AppSpecificFunctions::getNewActionButton($this,'Add EmailTemplateContentRow','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewEmailTemplateContentRow_Clicked');
        $this->EmailTemplateContentRowList = new EmailTemplateContentRowDataList($this, QQN::EmailTemplateContentRow(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function EmailTemplateContentRow_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailTemplateContentRowList->getActiveId() != $strParameter)
                $this->EmailTemplateContentRowList->setActiveId($strParameter);
            else
                $this->EmailTemplateContentRowList->setActiveId(null);
        $theObject = EmailTemplateContentRow::Load($strParameter);
        if ($theObject) {
            $this->EmailTemplateContentRowInstance->setObject($theObject);
            $this->EmailTemplateContentRowInstance->setValues($theObject);
            $this->EmailTemplateContentRowInstance->refreshAll();
            $this->btnDeleteEmailTemplateContentRow->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
        }
    }
    protected function EmailTemplateContentRow_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRow_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRow_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRow_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailTemplateContentRow_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewEmailTemplateContentRow_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailTemplateContentRowList->setActiveId(null);
        $this->EmailTemplateContentRowInstance->setObject(null);
        $this->EmailTemplateContentRowInstance->setValues(null);
        $this->btnDeleteEmailTemplateContentRow->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailTemplateContentRowModal');
    }
}
EmailTemplateContentRow_ListForm::Run('EmailTemplateContentRow_ListForm');
?>