<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailMessage/EmailMessageController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailMessage/EmailMessageDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}
class EmailMessage_OverviewForm extends QForm {
    // Data grid variables
    protected $EmailMessageGrid;
    protected $EmailMessageWaitControlIcon;
    protected $btnNewEmailMessage;
    protected $selectedEmailMessageId = -1;

    // EmailMessage Object variables
    protected $EmailMessageInstance;
    protected $btnSaveEmailMessage,$btnDeleteEmailMessage;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmailMessageDataGrid();
        $this->InitEmailMessageModal();
    }
    protected function InitEmailMessageModal() {
        $this->EmailMessageInstance = new EmailMessageController($this);

        $this->btnSaveEmailMessage = new QButton($this);
        $this->btnSaveEmailMessage->Text = 'Save EmailMessage';
        $this->btnSaveEmailMessage->CssClass = 'btn btn-success '.$this->buttonFullWidthCss;
        $this->btnSaveEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailMessage_Clicked'));

        $this->btnDeleteEmailMessage = new QButton($this);
        $this->btnDeleteEmailMessage->Text = 'Delete EmailMessage';
        $this->btnDeleteEmailMessage->CssClass = 'btn btn-danger '.$this->buttonFullWidthCss;
        $this->btnDeleteEmailMessage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailMessage_Clicked'));
    }
    protected function btnSaveEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailMessageInstance->saveObject()) {
            $this->EmailMessageGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailMessageModal');
        }
    }
    protected function btnDeleteEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailMessageInstance->deleteObject()) {
            $this->EmailMessageGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('EmailMessageModal');
        }
    }
    protected function InitEmailMessageDataGrid() {
        $searchableAttributes = array(QQN::EmailMessage()->SentDate,QQN::EmailMessage()->FromAddress,QQN::EmailMessage()->ReplyEmail,QQN::EmailMessage()->Recipients,QQN::EmailMessage()->Cc,QQN::EmailMessage()->Bcc,QQN::EmailMessage()->Subject,QQN::EmailMessage()->EmailMessage,QQN::EmailMessage()->Attachments,QQN::EmailMessage()->ErrorInfo);
        $headerItems = array('Sent Date','From Address','Reply Email','Recipients','Cc','Bcc','Subject','Email Message','Attachments','Error Info');
        $headerSortNodes = array(QQN::EmailMessage()->SentDate,QQN::EmailMessage()->FromAddress,QQN::EmailMessage()->ReplyEmail,QQN::EmailMessage()->Recipients,QQN::EmailMessage()->Cc,QQN::EmailMessage()->Bcc,QQN::EmailMessage()->Subject,QQN::EmailMessage()->EmailMessage,QQN::EmailMessage()->Attachments,QQN::EmailMessage()->ErrorInfo);
        $columnItems = array('SentDate','FromAddress','ReplyEmail','Recipients','Cc','Bcc','Subject','EmailMessage','Attachments','ErrorInfo');
        $this->EmailMessageWaitControlIcon = new QWaitIcon($this);
        $this->btnNewEmailMessage = new QButton($this);
        $this->btnNewEmailMessage->Text = 'Add EmailMessage';
        $this->btnNewEmailMessage->CssClass = 'btn btn-primary '.$this->buttonFullWidthCss;
        $this->btnNewEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnNewEmailMessage_Clicked'));
        $this->EmailMessageGrid = new EmailMessageDataGrid($this, QQN::EmailMessage(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->EmailMessageWaitControlIcon, 'EmailMessageGrid');
        $this->EmailMessageGrid->SetSortDirectionDown(false);
    }
    protected function EmailMessageGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessageGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessageGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessageGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessageGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessageGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailMessageId = $strParameter;
        $theObject = EmailMessage::Load($this->selectedEmailMessageId);
        if ($theObject) {
            $this->EmailMessageInstance->setObject($theObject);
            $this->EmailMessageInstance->setValues($theObject);
            $this->EmailMessageInstance->refreshAll();
            $this->btnDeleteEmailMessage->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailMessageModal');
        }
    }
    protected function btnNewEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedEmailMessageId = -1;
        $this->EmailMessageInstance->setObject(null);
        $this->EmailMessageInstance->setValues(null);
        $this->btnDeleteEmailMessage->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailMessageModal');
    }
}
EmailMessage_OverviewForm::Run('EmailMessage_OverviewForm');
?>