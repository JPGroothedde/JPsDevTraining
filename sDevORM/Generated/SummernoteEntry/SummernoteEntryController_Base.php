<?php
class SummernoteEntryController_Base {
    protected $Object;
    public $txtEntryHtml;
    public $txtAuthorId;
    public $txtLastChangedDate;
    public $lstLastChangedDateHours,$lstLastChangedDateMinutes;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtEntryHtml = new QTextBox($objParentObject);
        $this->txtEntryHtml->Name = 'Entry Html';

        $this->txtAuthorId = new QTextBox($objParentObject);
        $this->txtAuthorId->Name = 'Author Id';

        $this->txtLastChangedDate = new QTextBox($objParentObject);
        $this->txtLastChangedDate->Name = 'Last Changed Date';
        $this->txtLastChangedDate->CssClass = 'form-control input-date';

        $this->lstLastChangedDateHours = new QListBox($objParentObject);
        $this->lstLastChangedDateHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstLastChangedDateMinutes = new QListBox($objParentObject);
        $this->lstLastChangedDateMinutes->HtmlBefore = ' : ';
        $this->lstLastChangedDateMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstLastChangedDateHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstLastChangedDateHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstLastChangedDateMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstLastChangedDateMinutes->AddItem(new QListItem($display,$i));
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
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
        }
    }

    public function setValues($Object) {
        $this->txtEntryHtml->Text = '';
        $this->txtAuthorId->Text = '';
        $this->txtLastChangedDate->Text = '';
        $this->setLastChangedDateTime();

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->EntryHtml)) {
            $this->txtEntryHtml->Text = $Object->EntryHtml;
        }
        if (!is_null($Object->AuthorId)) {
            $this->txtAuthorId->Text = $Object->AuthorId;
        }
        if (!is_null($Object->LastChangedDate)) {
            $this->txtLastChangedDate->Text = $Object->LastChangedDate->format(DATE_TIME_FORMAT_HTML);
            $this->setLastChangedDateTime($Object->LastChangedDate);
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setLastChangedDateTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstLastChangedDateHours->SelectedIndex = 0;
            $this->lstLastChangedDateMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstLastChangedDateHours->SelectedValue = $time->format('H');
        $this->lstLastChangedDateMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'ENTRYHTML') {
            if (strlen($nameValue) > 0)
                $this->txtEntryHtml->Name = $nameValue;
            $output = $withName ? $this->txtEntryHtml->RenderWithName($blnPrintOutput):$this->txtEntryHtml->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'AUTHORID') {
            if (strlen($nameValue) > 0)
                $this->txtAuthorId->Name = $nameValue;
            $output = $withName ? $this->txtAuthorId->RenderWithName($blnPrintOutput):$this->txtAuthorId->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'LASTCHANGEDDATE') {
            if (strlen($nameValue) > 0)
                $this->txtLastChangedDate->Name = $nameValue;
            $output = $withName ? $this->txtLastChangedDate->RenderWithName($blnPrintOutput):$this->txtLastChangedDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'LASTCHANGEDDATETIME') {
            if ($withName) {
                $this->lstLastChangedDateHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstLastChangedDateHours->HtmlBefore = '';
            }
            $output = $this->lstLastChangedDateHours->Render($blnPrintOutput);
            $output .= $this->lstLastChangedDateMinutes->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('ENTRYHTML',$withName);
        $this->renderControl('AUTHORID',$withName);
        $this->renderControl('LASTCHANGEDDATE',$withName);
        $this->renderControl('LASTCHANGEDDATETIME',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('EntryHtml',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('AuthorId',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('LastChangedDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('LastChangedDateTIME',$withName, 'Time', false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtEntryHtml->Visible = false;
        $this->txtAuthorId->Visible = false;
        $this->txtLastChangedDate->Visible = false;
        $this->lstLastChangedDateHours->Visible = false;
        $this->lstLastChangedDateMinutes->Visible = false;
    }

    public function showAll() {
        $this->txtEntryHtml->Visible = true;
        $this->txtAuthorId->Visible = true;
        $this->txtLastChangedDate->Visible = true;
        $this->lstLastChangedDateHours->Visible = true;
        $this->lstLastChangedDateMinutes->Visible = true;
    }

    public function refreshAll() {
        $this->txtEntryHtml->Refresh();
        $this->txtAuthorId->Refresh();
        $this->txtLastChangedDate->Refresh();
        $this->lstLastChangedDateHours->Refresh();
        $this->lstLastChangedDateMinutes->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'ENTRYHTML':
                $this->txtEntryHtml->Text = $value;
                break;
            case 'AUTHORID':
                $this->txtAuthorId->Text = $value;
                break;
            case 'LASTCHANGEDDATE':
                $this->txtLastChangedDate->Text = $value;
                break;
            case 'LASTCHANGEDDATETIME':
                $this->setLastChangedDateTime($value);
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
            case 'ENTRYHTML':
                if ($this->txtEntryHtml->Text)
                    return $this->txtEntryHtml->Text;
                break;
            case 'AUTHORID':
                if ($this->txtAuthorId->Text)
                    return $this->txtAuthorId->Text;
                break;
            case 'LASTCHANGEDDATE':
                if ($this->txtLastChangedDate->Text)
                    return $this->txtLastChangedDate->Text;
                break;
            case 'LASTCHANGEDDATETIME':
                return $this->lstLastChangedDateHours->SelectedValue.':'.$this->lstLastChangedDateMinutes->SelectedValue;
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
            case 'ENTRYHTML':
                if ($this->txtEntryHtml)
                    return $this->txtEntryHtml->ControlId;
                break;
            case 'AUTHORID':
                if ($this->txtAuthorId)
                    return $this->txtAuthorId->ControlId;
                break;
            case 'LASTCHANGEDDATE':
                if ($this->txtLastChangedDate)
                    return $this->txtLastChangedDate->ControlId;
                break;
            case 'LASTCHANGEDDATEHOURS':
                if ($this->lstLastChangedDateHours)
                    return $this->lstLastChangedDateHours->ControlId;
                break;
            case 'LASTCHANGEDDATEMINUTES':
                if ($this->lstLastChangedDateMinutes)
                    return $this->lstLastChangedDateMinutes->ControlId;
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
            case 'ENTRYHTML':
                $this->txtEntryHtml->Visible = false;
                $this->txtEntryHtml->Refresh();
                break;
            case 'AUTHORID':
                $this->txtAuthorId->Visible = false;
                $this->txtAuthorId->Refresh();
                break;
            case 'LASTCHANGEDDATE':
                $this->txtLastChangedDate->Visible = false;
                $this->txtLastChangedDate->Refresh();
                break;
            case 'LASTCHANGEDDATETIME':
                $this->lstLastChangedDateHours->Visible = false;
                $this->lstLastChangedDateMinutes->Visible = false;
                $this->lstLastChangedDateHours->Refresh();
                $this->lstLastChangedDateMinutes->Refresh();
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
            case 'ENTRYHTML':
                $this->txtEntryHtml->Visible = true;
                $this->txtEntryHtml->Refresh();
                break;
            case 'AUTHORID':
                $this->txtAuthorId->Visible = true;
                $this->txtAuthorId->Refresh();
                break;
            case 'LASTCHANGEDDATE':
                $this->txtLastChangedDate->Visible = true;
                $this->txtLastChangedDate->Refresh();
                break;
            case 'LASTCHANGEDDATETIME':
                $this->lstLastChangedDateHours->Visible = true;
                $this->lstLastChangedDateMinutes->Visible = true;
                $this->lstLastChangedDateHours->Refresh();
                $this->lstLastChangedDateMinutes->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtEntryHtml->getJqControlId();
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
            $this->Object = new SummernoteEntry();
        
        $this->Object->EntryHtml = $this->txtEntryHtml->Text;
        $this->Object->AuthorId = $this->txtAuthorId->Text;
        if (strlen($this->txtLastChangedDate->Text) > 0) {
            if ($this->lstLastChangedDateHours->SelectedIndex > 0)
                $this->Object->LastChangedDate = new QDateTime($this->txtLastChangedDate->Text.' '.$this->lstLastChangedDateHours->SelectedValue.':'.$this->lstLastChangedDateMinutes->SelectedValue);
            else
                $this->Object->LastChangedDate = new QDateTime($this->txtLastChangedDate->Text);
        }
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEntryHtml);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtAuthorId);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtLastChangedDate);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtEntryHtml->WrapperCssClass = 'form-group';
            $this->txtEntryHtml->Placeholder = '';
            $this->txtAuthorId->WrapperCssClass = 'form-group';
            $this->txtAuthorId->Placeholder = '';
            $this->txtLastChangedDate->WrapperCssClass = 'form-group';
            $this->txtLastChangedDate->Placeholder = '';
        $js = AppSpecificFunctions::GetDatePickerInitJs();
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    public function saveWithAudit() {
        try {
            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            error_log('Could not save object. Error: '.$e->getMessage());
            return false;
        }
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object)
            $previousValues = SummernoteEntry::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'EntryHtml-> Value before: '.$previousValues->EntryHtml.', Value after: '.$this->Object->EntryHtml.'<br>
        AuthorId-> Value before: '.$previousValues->AuthorId.', Value after: '.$this->Object->AuthorId.'<br>
        LastChangedDate-> Value before: '.$previousValues->LastChangedDate.', Value after: '.$this->Object->LastChangedDate.'<br>
        ';
        } else {
        $changeText = 'EntryHtml-> Value: '.$this->Object->EntryHtml.'<br>
        AuthorId-> Value: '.$this->Object->AuthorId.'<br>
        LastChangedDate-> Value: '.$this->Object->LastChangedDate.'<br>
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
            $AuditLogEntry->ObjectName = 'SummernoteEntry';
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
                $AuditLogEntry->ObjectName = 'SummernoteEntry';
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