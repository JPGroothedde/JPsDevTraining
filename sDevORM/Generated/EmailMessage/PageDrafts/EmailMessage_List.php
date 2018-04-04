<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmailMessage/EmailMessageController.php');
require(__SDEV_CONTROLS__.'/Implementations/EmailMessage/EmailMessageDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmailMessage_ListForm extends QForm {
    // Data list variables
    protected $EmailMessageList;
    protected $btnNewEmailMessage;

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

        $this->InitEmailMessageDataList();
        $this->InitEmailMessageModal();
    }
    protected function InitEmailMessageModal() {
        $this->EmailMessageInstance = new EmailMessageController($this);

        $this->btnSaveEmailMessage = new QButton($this);
        $this->btnSaveEmailMessage->Text = 'Save';
        $this->btnSaveEmailMessage->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmailMessage_Clicked'));

        $this->btnDeleteEmailMessage = new QButton($this);
        $this->btnDeleteEmailMessage->Text = 'Delete';
        $this->btnDeleteEmailMessage->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteEmailMessage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmailMessage->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmailMessage_Clicked'));
    }
    protected function btnSaveEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailMessageInstance->saveObject()) {
            $this->EmailMessageList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailMessageModal');
        }
    }
    protected function btnDeleteEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailMessageInstance->deleteObject()) {
            $this->EmailMessageList->refreshList();
            AppSpecificFunctions::ToggleModal('EmailMessageModal');
        }
    }
    protected function InitEmailMessageDataList() {
        $searchableAttributes = array(QQN::EmailMessage()->SentDate,QQN::EmailMessage()->FromAddress,QQN::EmailMessage()->ReplyEmail,QQN::EmailMessage()->Recipients,QQN::EmailMessage()->Cc,QQN::EmailMessage()->Bcc,QQN::EmailMessage()->Subject,QQN::EmailMessage()->EmailMessage,QQN::EmailMessage()->Attachments,QQN::EmailMessage()->ErrorInfo);
        $SortAttributesShown = array('Sent Date','From Address','Reply Email','Recipients','Cc','Bcc','Subject','Email Message','Attachments','Error Info');
        $SortAttributes = array(QQN::EmailMessage()->SentDate,QQN::EmailMessage()->FromAddress,QQN::EmailMessage()->ReplyEmail,QQN::EmailMessage()->Recipients,QQN::EmailMessage()->Cc,QQN::EmailMessage()->Bcc,QQN::EmailMessage()->Subject,QQN::EmailMessage()->EmailMessage,QQN::EmailMessage()->Attachments,QQN::EmailMessage()->ErrorInfo);
        $columnItems = array('SentDate','FromAddress','ReplyEmail','Recipients','Cc','Bcc','Subject','EmailMessage','Attachments','ErrorInfo');
        $this->btnNewEmailMessage = AppSpecificFunctions::getNewActionButton($this,'Add EmailMessage','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewEmailMessage_Clicked');
        $this->EmailMessageList = new EmailMessageDataList($this, QQN::EmailMessage(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function EmailMessage_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmailMessageList->getActiveId() != $strParameter)
                $this->EmailMessageList->setActiveId($strParameter);
            else
                $this->EmailMessageList->setActiveId(null);
        $theObject = EmailMessage::Load($strParameter);
        if ($theObject) {
            $this->EmailMessageInstance->setObject($theObject);
            $this->EmailMessageInstance->setValues($theObject);
            $this->EmailMessageInstance->refreshAll();
            $this->btnDeleteEmailMessage->Visible = true;
            AppSpecificFunctions::ToggleModal('EmailMessageModal');
        }
    }
    protected function EmailMessage_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessage_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessage_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessage_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function EmailMessage_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewEmailMessage_Clicked($strFormId, $strControlId, $strParameter) {
        $this->EmailMessageList->setActiveId(null);
        $this->EmailMessageInstance->setObject(null);
        $this->EmailMessageInstance->setValues(null);
        $this->btnDeleteEmailMessage->Visible = false;
        AppSpecificFunctions::ToggleModal('EmailMessageModal');
    }
}
EmailMessage_ListForm::Run('EmailMessage_ListForm');
?>