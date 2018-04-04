<?php
class EmailMessageController_Base {
    protected $Object;
    public $txtSentDate;
    public $lstSentDateHours,$lstSentDateMinutes;
    public $txtFromAddress;
    public $txtReplyEmail;
    public $txtRecipients;
    public $txtCc;
    public $txtBcc;
    public $txtSubject;
    public $txtEmailMessage;
    public $txtAttachments;
    public $txtErrorInfo;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtSentDate = new QTextBox($objParentObject);
        $this->txtSentDate->Name = 'Sent Date';
        $this->txtSentDate->CssClass = 'form-control input-date';

        $this->lstSentDateHours = new QListBox($objParentObject);
        $this->lstSentDateHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstSentDateMinutes = new QListBox($objParentObject);
        $this->lstSentDateMinutes->HtmlBefore = ' : ';
        $this->lstSentDateMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstSentDateHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstSentDateHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstSentDateMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstSentDateMinutes->AddItem(new QListItem($display,$i));
        }
        
        $this->txtFromAddress = new QTextBox($objParentObject);
        $this->txtFromAddress->Name = 'From Address';

        $this->txtReplyEmail = new QTextBox($objParentObject);
        $this->txtReplyEmail->Name = 'Reply Email';

        $this->txtRecipients = new QTextBox($objParentObject);
        $this->txtRecipients->Name = 'Recipients';

        $this->txtCc = new QTextBox($objParentObject);
        $this->txtCc->Name = 'Cc';

        $this->txtBcc = new QTextBox($objParentObject);
        $this->txtBcc->Name = 'Bcc';

        $this->txtSubject = new QTextBox($objParentObject);
        $this->txtSubject->Name = 'Subject';

        $this->txtEmailMessage = new QTextBox($objParentObject);
        $this->txtEmailMessage->Name = 'Email Message';

        $this->txtAttachments = new QTextBox($objParentObject);
        $this->txtAttachments->Name = 'Attachments';

        $this->txtErrorInfo = new QTextBox($objParentObject);
        $this->txtErrorInfo->Name = 'Error Info';

        if ($InitObject)
            $this->Object = $InitObject;
        else
            $this->Object = null;
        $this->setValues($this->Object);
    }

    

    public function setObject($Object) {
        if ($Object)
            $this->Object = $Object;
        else
            $this->Object = null;
    }

    public function setReferenceListObjectDisplayAttribute($ReferenceObject = null,$ReferenceAttribute = null) {
        if ($ReferenceObject && $ReferenceAttribute) {
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
        }
    }

    public function setValues($Object) {
        $this->txtSentDate->Text = '';$this->setSentDateTime();
        $this->txtFromAddress->Text = '';
        $this->txtReplyEmail->Text = '';
        $this->txtRecipients->Text = '';
        $this->txtCc->Text = '';
        $this->txtBcc->Text = '';
        $this->txtSubject->Text = '';
        $this->txtEmailMessage->Text = '';
        $this->txtAttachments->Text = '';
        $this->txtErrorInfo->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->SentDate) {
            $this->txtSentDate->Text = $Object->SentDate->format(DATE_TIME_FORMAT_HTML);
            $this->setSentDateTime($Object->SentDate);
        }
        if ($Object->FromAddress) {
            $this->txtFromAddress->Text = $Object->FromAddress;
        }
        if ($Object->ReplyEmail) {
            $this->txtReplyEmail->Text = $Object->ReplyEmail;
        }
        if ($Object->Recipients) {
            $this->txtRecipients->Text = $Object->Recipients;
        }
        if ($Object->Cc) {
            $this->txtCc->Text = $Object->Cc;
        }
        if ($Object->Bcc) {
            $this->txtBcc->Text = $Object->Bcc;
        }
        if ($Object->Subject) {
            $this->txtSubject->Text = $Object->Subject;
        }
        if ($Object->EmailMessage) {
            $this->txtEmailMessage->Text = $Object->EmailMessage;
        }
        if ($Object->Attachments) {
            $this->txtAttachments->Text = $Object->Attachments;
        }
        if ($Object->ErrorInfo) {
            $this->txtErrorInfo->Text = $Object->ErrorInfo;
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setSentDateTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstSentDateHours->SelectedIndex = 0;
            $this->lstSentDateMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstSentDateHours->SelectedValue = $time->format('H');
        $this->lstSentDateMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'SENTDATE') {
            if (strlen($nameValue) > 0)
                $this->txtSentDate->Name = $nameValue;
            $output = $withName ? $this->txtSentDate->RenderWithName($blnPrintOutput):$this->txtSentDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'SENTDATETIME') {
            if ($withName) {
                $this->lstSentDateHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstSentDateHours->HtmlBefore = '';
            }
            $output = $this->lstSentDateHours->Render($blnPrintOutput);
            $output .= $this->lstSentDateMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'FROMADDRESS') {
            if (strlen($nameValue) > 0)
                $this->txtFromAddress->Name = $nameValue;
            $output = $withName ? $this->txtFromAddress->RenderWithName($blnPrintOutput):$this->txtFromAddress->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'REPLYEMAIL') {
            if (strlen($nameValue) > 0)
                $this->txtReplyEmail->Name = $nameValue;
            $output = $withName ? $this->txtReplyEmail->RenderWithName($blnPrintOutput):$this->txtReplyEmail->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'RECIPIENTS') {
            if (strlen($nameValue) > 0)
                $this->txtRecipients->Name = $nameValue;
            $output = $withName ? $this->txtRecipients->RenderWithName($blnPrintOutput):$this->txtRecipients->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CC') {
            if (strlen($nameValue) > 0)
                $this->txtCc->Name = $nameValue;
            $output = $withName ? $this->txtCc->RenderWithName($blnPrintOutput):$this->txtCc->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'BCC') {
            if (strlen($nameValue) > 0)
                $this->txtBcc->Name = $nameValue;
            $output = $withName ? $this->txtBcc->RenderWithName($blnPrintOutput):$this->txtBcc->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'SUBJECT') {
            if (strlen($nameValue) > 0)
                $this->txtSubject->Name = $nameValue;
            $output = $withName ? $this->txtSubject->RenderWithName($blnPrintOutput):$this->txtSubject->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'EMAILMESSAGE') {
            if (strlen($nameValue) > 0)
                $this->txtEmailMessage->Name = $nameValue;
            $output = $withName ? $this->txtEmailMessage->RenderWithName($blnPrintOutput):$this->txtEmailMessage->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ATTACHMENTS') {
            if (strlen($nameValue) > 0)
                $this->txtAttachments->Name = $nameValue;
            $output = $withName ? $this->txtAttachments->RenderWithName($blnPrintOutput):$this->txtAttachments->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ERRORINFO') {
            if (strlen($nameValue) > 0)
                $this->txtErrorInfo->Name = $nameValue;
            $output = $withName ? $this->txtErrorInfo->RenderWithName($blnPrintOutput):$this->txtErrorInfo->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('SENTDATE',$withName);
        $this->renderControl('SENTDATETIME',$withName);
        $this->renderControl('FROMADDRESS',$withName);
        $this->renderControl('REPLYEMAIL',$withName);
        $this->renderControl('RECIPIENTS',$withName);
        $this->renderControl('CC',$withName);
        $this->renderControl('BCC',$withName);
        $this->renderControl('SUBJECT',$withName);
        $this->renderControl('EMAILMESSAGE',$withName);
        $this->renderControl('ATTACHMENTS',$withName);
        $this->renderControl('ERRORINFO',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('SentDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('SentDateTIME',$withName, 'Time', false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('FromAddress',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('ReplyEmail',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Recipients',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Cc',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Bcc',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Subject',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EmailMessage',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Attachments',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('ErrorInfo',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtSentDate->Visible = false;
        $this->lstSentDateHours->Visible = false;
        $this->lstSentDateMinutes->Visible = false;
        $this->txtFromAddress->Visible = false;
        $this->txtReplyEmail->Visible = false;
        $this->txtRecipients->Visible = false;
        $this->txtCc->Visible = false;
        $this->txtBcc->Visible = false;
        $this->txtSubject->Visible = false;
        $this->txtEmailMessage->Visible = false;
        $this->txtAttachments->Visible = false;
        $this->txtErrorInfo->Visible = false;
    }

    public function showAll() {
        $this->txtSentDate->Visible = true;
        $this->lstSentDateHours->Visible = true;
        $this->lstSentDateMinutes->Visible = true;
        $this->txtFromAddress->Visible = true;
        $this->txtReplyEmail->Visible = true;
        $this->txtRecipients->Visible = true;
        $this->txtCc->Visible = true;
        $this->txtBcc->Visible = true;
        $this->txtSubject->Visible = true;
        $this->txtEmailMessage->Visible = true;
        $this->txtAttachments->Visible = true;
        $this->txtErrorInfo->Visible = true;
    }

    public function refreshAll() {
        $this->txtSentDate->Refresh();
        $this->lstSentDateHours->Refresh();
        $this->lstSentDateMinutes->Refresh();
        $this->txtFromAddress->Refresh();
        $this->txtReplyEmail->Refresh();
        $this->txtRecipients->Refresh();
        $this->txtCc->Refresh();
        $this->txtBcc->Refresh();
        $this->txtSubject->Refresh();
        $this->txtEmailMessage->Refresh();
        $this->txtAttachments->Refresh();
        $this->txtErrorInfo->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'SENTDATE':
                $this->txtSentDate->Text = $value;
                break;
            case 'SENTDATETIME':
                $this->setSentDateTime($value);
                break;
            case 'FROMADDRESS':
                $this->txtFromAddress->Text = $value;
                break;
            case 'REPLYEMAIL':
                $this->txtReplyEmail->Text = $value;
                break;
            case 'RECIPIENTS':
                $this->txtRecipients->Text = $value;
                break;
            case 'CC':
                $this->txtCc->Text = $value;
                break;
            case 'BCC':
                $this->txtBcc->Text = $value;
                break;
            case 'SUBJECT':
                $this->txtSubject->Text = $value;
                break;
            case 'EMAILMESSAGE':
                $this->txtEmailMessage->Text = $value;
                break;
            case 'ATTACHMENTS':
                $this->txtAttachments->Text = $value;
                break;
            case 'ERRORINFO':
                $this->txtErrorInfo->Text = $value;
                break;
            default:
                break;
        }
        return null;
    }


    public function getValue($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'SENTDATE':
                if ($this->txtSentDate->Text)
                    return $this->txtSentDate->Text;
                break;
            case 'SENTDATETIME':
                return $this->lstSentDateHours->SelectedValue.':'.$this->lstSentDateMinutes->SelectedValue;
                break;
            case 'FROMADDRESS':
                if ($this->txtFromAddress->Text)
                    return $this->txtFromAddress->Text;
                break;
            case 'REPLYEMAIL':
                if ($this->txtReplyEmail->Text)
                    return $this->txtReplyEmail->Text;
                break;
            case 'RECIPIENTS':
                if ($this->txtRecipients->Text)
                    return $this->txtRecipients->Text;
                break;
            case 'CC':
                if ($this->txtCc->Text)
                    return $this->txtCc->Text;
                break;
            case 'BCC':
                if ($this->txtBcc->Text)
                    return $this->txtBcc->Text;
                break;
            case 'SUBJECT':
                if ($this->txtSubject->Text)
                    return $this->txtSubject->Text;
                break;
            case 'EMAILMESSAGE':
                if ($this->txtEmailMessage->Text)
                    return $this->txtEmailMessage->Text;
                break;
            case 'ATTACHMENTS':
                if ($this->txtAttachments->Text)
                    return $this->txtAttachments->Text;
                break;
            case 'ERRORINFO':
                if ($this->txtErrorInfo->Text)
                    return $this->txtErrorInfo->Text;
                break;
            default:
                break;
        }
        return null;
    }


    public function getControlId($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'SENTDATE':
                if ($this->txtSentDate)
                    return $this->txtSentDate->ControlId;
                break;
            case 'SENTDATEHOURS':
                if ($this->lstSentDateHours)
                    return $this->lstSentDateHours->ControlId;
                break;
            case 'SENTDATEMINUTES':
                if ($this->lstSentDateMinutes)
                    return $this->lstSentDateMinutes->ControlId;
                break;
            case 'FROMADDRESS':
                if ($this->txtFromAddress)
                    return $this->txtFromAddress->ControlId;
                break;
            case 'REPLYEMAIL':
                if ($this->txtReplyEmail)
                    return $this->txtReplyEmail->ControlId;
                break;
            case 'RECIPIENTS':
                if ($this->txtRecipients)
                    return $this->txtRecipients->ControlId;
                break;
            case 'CC':
                if ($this->txtCc)
                    return $this->txtCc->ControlId;
                break;
            case 'BCC':
                if ($this->txtBcc)
                    return $this->txtBcc->ControlId;
                break;
            case 'SUBJECT':
                if ($this->txtSubject)
                    return $this->txtSubject->ControlId;
                break;
            case 'EMAILMESSAGE':
                if ($this->txtEmailMessage)
                    return $this->txtEmailMessage->ControlId;
                break;
            case 'ATTACHMENTS':
                if ($this->txtAttachments)
                    return $this->txtAttachments->ControlId;
                break;
            case 'ERRORINFO':
                if ($this->txtErrorInfo)
                    return $this->txtErrorInfo->ControlId;
                break;
            default:
                break;
        }
        return null;
    }


    public function hideControl($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'SENTDATE':
                $this->txtSentDate->Visible = false;
                $this->txtSentDate->Refresh();
                break;
            case 'SENTDATETIME':
                $this->lstSentDateHours->Visible = false;
                $this->lstSentDateMinutes->Visible = false;
                $this->lstSentDateHours->Refresh();
                $this->lstSentDateMinutes->Refresh();
                break;
            case 'FROMADDRESS':
                $this->txtFromAddress->Visible = false;
                $this->txtFromAddress->Refresh();
                break;
            case 'REPLYEMAIL':
                $this->txtReplyEmail->Visible = false;
                $this->txtReplyEmail->Refresh();
                break;
            case 'RECIPIENTS':
                $this->txtRecipients->Visible = false;
                $this->txtRecipients->Refresh();
                break;
            case 'CC':
                $this->txtCc->Visible = false;
                $this->txtCc->Refresh();
                break;
            case 'BCC':
                $this->txtBcc->Visible = false;
                $this->txtBcc->Refresh();
                break;
            case 'SUBJECT':
                $this->txtSubject->Visible = false;
                $this->txtSubject->Refresh();
                break;
            case 'EMAILMESSAGE':
                $this->txtEmailMessage->Visible = false;
                $this->txtEmailMessage->Refresh();
                break;
            case 'ATTACHMENTS':
                $this->txtAttachments->Visible = false;
                $this->txtAttachments->Refresh();
                break;
            case 'ERRORINFO':
                $this->txtErrorInfo->Visible = false;
                $this->txtErrorInfo->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function showControl($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'SENTDATE':
                $this->txtSentDate->Visible = true;
                $this->txtSentDate->Refresh();
                break;
            case 'SENTDATETIME':
                $this->lstSentDateHours->Visible = true;
                $this->lstSentDateMinutes->Visible = true;
                $this->lstSentDateHours->Refresh();
                $this->lstSentDateMinutes->Refresh();
                break;
            case 'FROMADDRESS':
                $this->txtFromAddress->Visible = true;
                $this->txtFromAddress->Refresh();
                break;
            case 'REPLYEMAIL':
                $this->txtReplyEmail->Visible = true;
                $this->txtReplyEmail->Refresh();
                break;
            case 'RECIPIENTS':
                $this->txtRecipients->Visible = true;
                $this->txtRecipients->Refresh();
                break;
            case 'CC':
                $this->txtCc->Visible = true;
                $this->txtCc->Refresh();
                break;
            case 'BCC':
                $this->txtBcc->Visible = true;
                $this->txtBcc->Refresh();
                break;
            case 'SUBJECT':
                $this->txtSubject->Visible = true;
                $this->txtSubject->Refresh();
                break;
            case 'EMAILMESSAGE':
                $this->txtEmailMessage->Visible = true;
                $this->txtEmailMessage->Refresh();
                break;
            case 'ATTACHMENTS':
                $this->txtAttachments->Visible = true;
                $this->txtAttachments->Refresh();
                break;
            case 'ERRORINFO':
                $this->txtErrorInfo->Visible = true;
                $this->txtErrorInfo->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtSentDate->getJqControlId();
    }

    public function getObject () {
        return $this->Object;
    }

    public function getObjectId() {
        if ($this->Object)
            return $this->Object->Id;
        else
            return -1;
    }

    public function applyValuesBeforeSaveObject()  {
        if (!$this->Object)
            $this->Object = new EmailMessage();
        
        if (strlen($this->txtSentDate->Text) > 0) {
            if ($this->lstSentDateHours->SelectedIndex > 0)
                $this->Object->SentDate = new QDateTime($this->txtSentDate->Text.' '.$this->lstSentDateHours->SelectedValue.':'.$this->lstSentDateMinutes->SelectedValue);
            else
                $this->Object->SentDate = new QDateTime($this->txtSentDate->Text);
        }
        $this->Object->FromAddress = $this->txtFromAddress->Text;
        $this->Object->ReplyEmail = $this->txtReplyEmail->Text;
        $this->Object->Recipients = $this->txtRecipients->Text;
        $this->Object->Cc = $this->txtCc->Text;
        $this->Object->Bcc = $this->txtBcc->Text;
        $this->Object->Subject = $this->txtSubject->Text;
        $this->Object->EmailMessage = $this->txtEmailMessage->Text;
        $this->Object->Attachments = $this->txtAttachments->Text;
        $this->Object->ErrorInfo = $this->txtErrorInfo->Text;
    }

    public function saveObject($validate = true)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject();
        
        return $this->saveWithAudit();
    }

    public function deleteObject()  {
        if (!$this->deleteWithAudit()) {
            AppSpecificFunctions::DisplayAlert('Could not delete the object right now. Please try again later...');
            return false;
        }
        return true;
    }

    public function validateObject()  {
        $hasNoErrors = true;
        //$this->resetValidation();
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtSentDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFromAddress);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtReplyEmail);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtRecipients);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtCc);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtBcc);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtSubject);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEmailMessage);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtAttachments);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtErrorInfo);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtSentDate->WrapperCssClass = 'form-group';
            $this->txtSentDate->Placeholder = '';
            $this->txtFromAddress->WrapperCssClass = 'form-group';
            $this->txtFromAddress->Placeholder = '';
            $this->txtReplyEmail->WrapperCssClass = 'form-group';
            $this->txtReplyEmail->Placeholder = '';
            $this->txtRecipients->WrapperCssClass = 'form-group';
            $this->txtRecipients->Placeholder = '';
            $this->txtCc->WrapperCssClass = 'form-group';
            $this->txtCc->Placeholder = '';
            $this->txtBcc->WrapperCssClass = 'form-group';
            $this->txtBcc->Placeholder = '';
            $this->txtSubject->WrapperCssClass = 'form-group';
            $this->txtSubject->Placeholder = '';
            $this->txtEmailMessage->WrapperCssClass = 'form-group';
            $this->txtEmailMessage->Placeholder = '';
            $this->txtAttachments->WrapperCssClass = 'form-group';
            $this->txtAttachments->Placeholder = '';
            $this->txtErrorInfo->WrapperCssClass = 'form-group';
            $this->txtErrorInfo->Placeholder = '';
        $js = AppSpecificFunctions::GetDatePickerInitJs();
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    public function saveWithAudit() {
        try {
            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            AppSpecificFunctions::AddCustomLog('Could not save object. Error: '.$e->getMessage());
            return false;
        }
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object)
            $previousValues = EmailMessage::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'SentDate-> Value before: '.$previousValues->SentDate.', Value after: '.$this->Object->SentDate.'<br>
        FromAddress-> Value before: '.$previousValues->FromAddress.', Value after: '.$this->Object->FromAddress.'<br>
        ReplyEmail-> Value before: '.$previousValues->ReplyEmail.', Value after: '.$this->Object->ReplyEmail.'<br>
        Recipients-> Value before: '.$previousValues->Recipients.', Value after: '.$this->Object->Recipients.'<br>
        Cc-> Value before: '.$previousValues->Cc.', Value after: '.$this->Object->Cc.'<br>
        Bcc-> Value before: '.$previousValues->Bcc.', Value after: '.$this->Object->Bcc.'<br>
        Subject-> Value before: '.$previousValues->Subject.', Value after: '.$this->Object->Subject.'<br>
        EmailMessage-> Value before: '.$previousValues->EmailMessage.', Value after: '.$this->Object->EmailMessage.'<br>
        Attachments-> Value before: '.$previousValues->Attachments.', Value after: '.$this->Object->Attachments.'<br>
        ErrorInfo-> Value before: '.$previousValues->ErrorInfo.', Value after: '.$this->Object->ErrorInfo.'<br>
        ';
        } else {
        $changeText = 'SentDate-> Value: '.$this->Object->SentDate.'<br>
        FromAddress-> Value: '.$this->Object->FromAddress.'<br>
        ReplyEmail-> Value: '.$this->Object->ReplyEmail.'<br>
        Recipients-> Value: '.$this->Object->Recipients.'<br>
        Cc-> Value: '.$this->Object->Cc.'<br>
        Bcc-> Value: '.$this->Object->Bcc.'<br>
        Subject-> Value: '.$this->Object->Subject.'<br>
        EmailMessage-> Value: '.$this->Object->EmailMessage.'<br>
        Attachments-> Value: '.$this->Object->Attachments.'<br>
        ErrorInfo-> Value: '.$this->Object->ErrorInfo.'<br>
        ';
        }
        try {
            $AuditLogEntry = new AuditLogEntry();
            $AuditLogEntry->EntryTimeStamp = QDateTime::Now(true);
            $AuditLogEntry->ModificationType = 'Create';
            if ($previousValues) {
                $AuditLogEntry->ObjectId = $this->Object->Id;
                $AuditLogEntry->ModificationType = 'Update';
            }
            $AuditLogEntry->ObjectName = 'EmailMessage';
            $AuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $AuditLogEntry->AuditLogEntryDetail = $changeText;
            $AuditLogEntry->Save();

            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            AppSpecificFunctions::DisplayAlert('Could not save right now. Please try again later...');
            return false;
        }*/
    }

    public function deleteWithAudit() {
        $this->Object->Delete();
        return true;
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object){
            try {
                $AuditLogEntry = new AuditLogEntry();
                $AuditLogEntry->EntryTimeStamp = QDateTime::Now(true);
                $AuditLogEntry->ModificationType = 'Delete';
                $AuditLogEntry->ObjectName = 'EmailMessage';
                $AuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
                $AuditLogEntry->AuditLogEntryDetail = '';
                $AuditLogEntry->ObjectId = $this->Object->Id;
                $AuditLogEntry->Save();
                $this->Object->Delete();
                return true;
            } catch (QCallerException $e) {
                return false;
            }
        } else
            return false;
        */
    }

    
};
?>