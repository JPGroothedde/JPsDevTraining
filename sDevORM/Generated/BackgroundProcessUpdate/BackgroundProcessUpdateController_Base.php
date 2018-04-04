<?php
class BackgroundProcessUpdateController_Base {
    protected $Object;
    public $txtUpdateDateTime;
    public $lstUpdateDateTimeHours,$lstUpdateDateTimeMinutes;
    public $txtUpdateMessage;
    public $lstBackgroundProcess,$saveUsingLstBackgroundProcess = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtUpdateDateTime = new QTextBox($objParentObject);
        $this->txtUpdateDateTime->Name = 'Update Date Time';
        $this->txtUpdateDateTime->CssClass = 'form-control input-date';

        $this->lstUpdateDateTimeHours = new QListBox($objParentObject);
        $this->lstUpdateDateTimeHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstUpdateDateTimeMinutes = new QListBox($objParentObject);
        $this->lstUpdateDateTimeMinutes->HtmlBefore = ' : ';
        $this->lstUpdateDateTimeMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstUpdateDateTimeHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstUpdateDateTimeHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstUpdateDateTimeMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstUpdateDateTimeMinutes->AddItem(new QListItem($display,$i));
        }
        
        $this->txtUpdateMessage = new QTextBox($objParentObject);
        $this->txtUpdateMessage->Name = 'Update Message';

        $this->lstBackgroundProcess = new QListBox($objParentObject);
        $this->lstBackgroundProcess->Name = 'Background Process';
        $this->lstBackgroundProcess->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allBackgroundProcess = BackgroundProcess::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allBackgroundProcess as $BackgroundProcess) {
            $this->lstBackgroundProcess->AddItem(new QListItem($BackgroundProcess->Id,$BackgroundProcess->Id));
        }

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
            if ($ReferenceObject == 'BackgroundProcess') {
                $this->lstBackgroundProcess->RemoveAllItems();
                $allBackgroundProcess_list = BackgroundProcess::LoadAll();
                foreach ($allBackgroundProcess_list as $BackgroundProcess) {
                    $this->lstBackgroundProcess->AddItem(new QListItem($BackgroundProcess->__get($ReferenceAttribute),$BackgroundProcess->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'BackgroundProcess') {
                $this->saveUsingLstBackgroundProcess = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtUpdateDateTime->Text = '';$this->setUpdateDateTimeTime();
        $this->txtUpdateMessage->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->UpdateDateTime) {
            $this->txtUpdateDateTime->Text = $Object->UpdateDateTime->format(DATE_TIME_FORMAT_HTML);
            $this->setUpdateDateTimeTime($Object->UpdateDateTime);
        }
        if ($Object->UpdateMessage) {
            $this->txtUpdateMessage->Text = $Object->UpdateMessage;
        }
        
        if ($Object->BackgroundProcessObject) {
            $this->lstBackgroundProcess->SelectedValue = $Object->BackgroundProcessObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setUpdateDateTimeTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstUpdateDateTimeHours->SelectedIndex = 0;
            $this->lstUpdateDateTimeMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstUpdateDateTimeHours->SelectedValue = $time->format('H');
        $this->lstUpdateDateTimeMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'UPDATEDATETIME') {
            if (strlen($nameValue) > 0)
                $this->txtUpdateDateTime->Name = $nameValue;
            $output = $withName ? $this->txtUpdateDateTime->RenderWithName($blnPrintOutput):$this->txtUpdateDateTime->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'UPDATEDATETIMETIME') {
            if ($withName) {
                $this->lstUpdateDateTimeHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstUpdateDateTimeHours->HtmlBefore = '';
            }
            $output = $this->lstUpdateDateTimeHours->Render($blnPrintOutput);
            $output .= $this->lstUpdateDateTimeMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'UPDATEMESSAGE') {
            if (strlen($nameValue) > 0)
                $this->txtUpdateMessage->Name = $nameValue;
            $output = $withName ? $this->txtUpdateMessage->RenderWithName($blnPrintOutput):$this->txtUpdateMessage->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'BACKGROUNDPROCESS') {
            if (strlen($nameValue) > 0)
                $this->lstBackgroundProcess->Name = $nameValue;
            $output = $withName ? $this->lstBackgroundProcess->RenderWithName($blnPrintOutput):$this->lstBackgroundProcess->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('UPDATEDATETIME',$withName);
        $this->renderControl('UPDATEDATETIMETIME',$withName);
        $this->renderControl('UPDATEMESSAGE',$withName);
        $this->renderControl('BACKGROUNDPROCESS',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('UpdateDateTime',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UpdateDateTimeTIME',$withName, 'Time', false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UpdateMessage',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtUpdateDateTime->Visible = false;
        $this->lstUpdateDateTimeHours->Visible = false;
        $this->lstUpdateDateTimeMinutes->Visible = false;
        $this->txtUpdateMessage->Visible = false;
        $this->lstBackgroundProcess->Visible = false;
    }

    public function showAll() {
        $this->txtUpdateDateTime->Visible = true;
        $this->lstUpdateDateTimeHours->Visible = true;
        $this->lstUpdateDateTimeMinutes->Visible = true;
        $this->txtUpdateMessage->Visible = true;
        $this->lstBackgroundProcess->Visible = true;
    }

    public function refreshAll() {
        $this->txtUpdateDateTime->Refresh();
        $this->lstUpdateDateTimeHours->Refresh();
        $this->lstUpdateDateTimeMinutes->Refresh();
        $this->txtUpdateMessage->Refresh();
        $this->lstBackgroundProcess->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'UPDATEDATETIME':
                $this->txtUpdateDateTime->Text = $value;
                break;
            case 'UPDATEDATETIMETIME':
                $this->setUpdateDateTimeTime($value);
                break;
            case 'UPDATEMESSAGE':
                $this->txtUpdateMessage->Text = $value;
                break;
            case 'BACKGROUNDPROCESS':
                $this->lstBackgroundProcess->SelectedValue = $value;
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
            case 'UPDATEDATETIME':
                if ($this->txtUpdateDateTime->Text)
                    return $this->txtUpdateDateTime->Text;
                break;
            case 'UPDATEDATETIMETIME':
                return $this->lstUpdateDateTimeHours->SelectedValue.':'.$this->lstUpdateDateTimeMinutes->SelectedValue;
                break;
            case 'UPDATEMESSAGE':
                if ($this->txtUpdateMessage->Text)
                    return $this->txtUpdateMessage->Text;
                break;
            case 'BACKGROUNDPROCESS':
                if ($this->lstBackgroundProcess->SelectedValue)
                    return $this->lstBackgroundProcess->SelectedValue;
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
            case 'UPDATEDATETIME':
                if ($this->txtUpdateDateTime)
                    return $this->txtUpdateDateTime->ControlId;
                break;
            case 'UPDATEDATETIMEHOURS':
                if ($this->lstUpdateDateTimeHours)
                    return $this->lstUpdateDateTimeHours->ControlId;
                break;
            case 'UPDATEDATETIMEMINUTES':
                if ($this->lstUpdateDateTimeMinutes)
                    return $this->lstUpdateDateTimeMinutes->ControlId;
                break;
            case 'UPDATEMESSAGE':
                if ($this->txtUpdateMessage)
                    return $this->txtUpdateMessage->ControlId;
                break;
            case 'BACKGROUNDPROCESS':
                if ($this->lstBackgroundProcess)
                    return $this->lstBackgroundProcess->ControlId;
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
            case 'UPDATEDATETIME':
                $this->txtUpdateDateTime->Visible = false;
                $this->txtUpdateDateTime->Refresh();
                break;
            case 'UPDATEDATETIMETIME':
                $this->lstUpdateDateTimeHours->Visible = false;
                $this->lstUpdateDateTimeMinutes->Visible = false;
                $this->lstUpdateDateTimeHours->Refresh();
                $this->lstUpdateDateTimeMinutes->Refresh();
                break;
            case 'UPDATEMESSAGE':
                $this->txtUpdateMessage->Visible = false;
                $this->txtUpdateMessage->Refresh();
                break;
            case 'BACKGROUNDPROCESS':
                $this->lstBackgroundProcess->Visible = false;
                $this->lstBackgroundProcess->Refresh();
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
            case 'UPDATEDATETIME':
                $this->txtUpdateDateTime->Visible = true;
                $this->txtUpdateDateTime->Refresh();
                break;
            case 'UPDATEDATETIMETIME':
                $this->lstUpdateDateTimeHours->Visible = true;
                $this->lstUpdateDateTimeMinutes->Visible = true;
                $this->lstUpdateDateTimeHours->Refresh();
                $this->lstUpdateDateTimeMinutes->Refresh();
                break;
            case 'UPDATEMESSAGE':
                $this->txtUpdateMessage->Visible = true;
                $this->txtUpdateMessage->Refresh();
                break;
            case 'BACKGROUNDPROCESS':
                $this->lstBackgroundProcess->Visible = true;
                $this->lstBackgroundProcess->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtUpdateDateTime->getJqControlId();
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

    public function applyValuesBeforeSaveObject($BackgroundProcess = null)  {
        if (!$this->Object)
            $this->Object = new BackgroundProcessUpdate();
        
        if (strlen($this->txtUpdateDateTime->Text) > 0) {
            if ($this->lstUpdateDateTimeHours->SelectedIndex > 0)
                $this->Object->UpdateDateTime = new QDateTime($this->txtUpdateDateTime->Text.' '.$this->lstUpdateDateTimeHours->SelectedValue.':'.$this->lstUpdateDateTimeMinutes->SelectedValue);
            else
                $this->Object->UpdateDateTime = new QDateTime($this->txtUpdateDateTime->Text);
        }
        $this->Object->UpdateMessage = $this->txtUpdateMessage->Text;
        if ($BackgroundProcess) {
            $this->Object->BackgroundProcessObject = $BackgroundProcess;
        }
        if ($this->saveUsingLstBackgroundProcess) {
            $linkedBackgroundProcess = BackgroundProcess::Load($this->lstBackgroundProcess->SelectedValue);
            $this->Object->BackgroundProcessObject = $linkedBackgroundProcess;
        }
    }

    public function saveObject($validate = true,$BackgroundProcess = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($BackgroundProcess);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUpdateDateTime);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUpdateMessage);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtUpdateDateTime->WrapperCssClass = 'form-group';
            $this->txtUpdateDateTime->Placeholder = '';
            $this->txtUpdateMessage->WrapperCssClass = 'form-group';
            $this->txtUpdateMessage->Placeholder = '';
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
            $previousValues = BackgroundProcessUpdate::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'UpdateDateTime-> Value before: '.$previousValues->UpdateDateTime.', Value after: '.$this->Object->UpdateDateTime.'<br>
        UpdateMessage-> Value before: '.$previousValues->UpdateMessage.', Value after: '.$this->Object->UpdateMessage.'<br>
        ';
        } else {
        $changeText = 'UpdateDateTime-> Value: '.$this->Object->UpdateDateTime.'<br>
        UpdateMessage-> Value: '.$this->Object->UpdateMessage.'<br>
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
            $AuditLogEntry->ObjectName = 'BackgroundProcessUpdate';
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
                $AuditLogEntry->ObjectName = 'BackgroundProcessUpdate';
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