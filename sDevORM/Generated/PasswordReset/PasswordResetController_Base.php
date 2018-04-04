<?php
class PasswordResetController_Base {
    protected $Object;
    public $txtToken;
    public $txtCreatedDateTime;
    public $lstCreatedDateTimeHours,$lstCreatedDateTimeMinutes;
    public $lstAccount,$saveUsingLstAccount = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtToken = new QTextBox($objParentObject);
        $this->txtToken->Name = 'Token';

        $this->txtCreatedDateTime = new QTextBox($objParentObject);
        $this->txtCreatedDateTime->Name = 'Created Date Time';
        $this->txtCreatedDateTime->CssClass = 'form-control input-date';

        $this->lstCreatedDateTimeHours = new QListBox($objParentObject);
        $this->lstCreatedDateTimeHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstCreatedDateTimeMinutes = new QListBox($objParentObject);
        $this->lstCreatedDateTimeMinutes->HtmlBefore = ' : ';
        $this->lstCreatedDateTimeMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstCreatedDateTimeHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstCreatedDateTimeHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstCreatedDateTimeMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstCreatedDateTimeMinutes->AddItem(new QListItem($display,$i));
        }
        
        $this->lstAccount = new QListBox($objParentObject);
        $this->lstAccount->Name = 'Account';
        $this->lstAccount->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allAccount = Account::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allAccount as $Account) {
            $this->lstAccount->AddItem(new QListItem($Account->Id,$Account->Id));
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
            if ($ReferenceObject == 'Account') {
                $this->lstAccount->RemoveAllItems();
                $allAccount_list = Account::LoadAll();
                foreach ($allAccount_list as $Account) {
                    $this->lstAccount->AddItem(new QListItem($Account->__get($ReferenceAttribute),$Account->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Account') {
                $this->saveUsingLstAccount = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtToken->Text = '';
        $this->txtCreatedDateTime->Text = '';$this->setCreatedDateTimeTime();

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->Token) {
            $this->txtToken->Text = $Object->Token;
        }
        if ($Object->CreatedDateTime) {
            $this->txtCreatedDateTime->Text = $Object->CreatedDateTime->format(DATE_TIME_FORMAT_HTML);
            $this->setCreatedDateTimeTime($Object->CreatedDateTime);
        }
        
        if ($Object->AccountObject) {
            $this->lstAccount->SelectedValue = $Object->AccountObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setCreatedDateTimeTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstCreatedDateTimeHours->SelectedIndex = 0;
            $this->lstCreatedDateTimeMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstCreatedDateTimeHours->SelectedValue = $time->format('H');
        $this->lstCreatedDateTimeMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'TOKEN') {
            if (strlen($nameValue) > 0)
                $this->txtToken->Name = $nameValue;
            $output = $withName ? $this->txtToken->RenderWithName($blnPrintOutput):$this->txtToken->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CREATEDDATETIME') {
            if (strlen($nameValue) > 0)
                $this->txtCreatedDateTime->Name = $nameValue;
            $output = $withName ? $this->txtCreatedDateTime->RenderWithName($blnPrintOutput):$this->txtCreatedDateTime->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CREATEDDATETIMETIME') {
            if ($withName) {
                $this->lstCreatedDateTimeHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstCreatedDateTimeHours->HtmlBefore = '';
            }
            $output = $this->lstCreatedDateTimeHours->Render($blnPrintOutput);
            $output .= $this->lstCreatedDateTimeMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ACCOUNT') {
            if (strlen($nameValue) > 0)
                $this->lstAccount->Name = $nameValue;
            $output = $withName ? $this->lstAccount->RenderWithName($blnPrintOutput):$this->lstAccount->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('TOKEN',$withName);
        $this->renderControl('CREATEDDATETIME',$withName);
        $this->renderControl('CREATEDDATETIMETIME',$withName);
        $this->renderControl('ACCOUNT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Token',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('CreatedDateTime',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('CreatedDateTimeTIME',$withName, 'Time', false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtToken->Visible = false;
        $this->txtCreatedDateTime->Visible = false;
        $this->lstCreatedDateTimeHours->Visible = false;
        $this->lstCreatedDateTimeMinutes->Visible = false;
        $this->lstAccount->Visible = false;
    }

    public function showAll() {
        $this->txtToken->Visible = true;
        $this->txtCreatedDateTime->Visible = true;
        $this->lstCreatedDateTimeHours->Visible = true;
        $this->lstCreatedDateTimeMinutes->Visible = true;
        $this->lstAccount->Visible = true;
    }

    public function refreshAll() {
        $this->txtToken->Refresh();
        $this->txtCreatedDateTime->Refresh();
        $this->lstCreatedDateTimeHours->Refresh();
        $this->lstCreatedDateTimeMinutes->Refresh();
        $this->lstAccount->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'TOKEN':
                $this->txtToken->Text = $value;
                break;
            case 'CREATEDDATETIME':
                $this->txtCreatedDateTime->Text = $value;
                break;
            case 'CREATEDDATETIMETIME':
                $this->setCreatedDateTimeTime($value);
                break;
            case 'ACCOUNT':
                $this->lstAccount->SelectedValue = $value;
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
            case 'TOKEN':
                if ($this->txtToken->Text)
                    return $this->txtToken->Text;
                break;
            case 'CREATEDDATETIME':
                if ($this->txtCreatedDateTime->Text)
                    return $this->txtCreatedDateTime->Text;
                break;
            case 'CREATEDDATETIMETIME':
                return $this->lstCreatedDateTimeHours->SelectedValue.':'.$this->lstCreatedDateTimeMinutes->SelectedValue;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount->SelectedValue)
                    return $this->lstAccount->SelectedValue;
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
            case 'TOKEN':
                if ($this->txtToken)
                    return $this->txtToken->ControlId;
                break;
            case 'CREATEDDATETIME':
                if ($this->txtCreatedDateTime)
                    return $this->txtCreatedDateTime->ControlId;
                break;
            case 'CREATEDDATETIMEHOURS':
                if ($this->lstCreatedDateTimeHours)
                    return $this->lstCreatedDateTimeHours->ControlId;
                break;
            case 'CREATEDDATETIMEMINUTES':
                if ($this->lstCreatedDateTimeMinutes)
                    return $this->lstCreatedDateTimeMinutes->ControlId;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount)
                    return $this->lstAccount->ControlId;
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
            case 'TOKEN':
                $this->txtToken->Visible = false;
                $this->txtToken->Refresh();
                break;
            case 'CREATEDDATETIME':
                $this->txtCreatedDateTime->Visible = false;
                $this->txtCreatedDateTime->Refresh();
                break;
            case 'CREATEDDATETIMETIME':
                $this->lstCreatedDateTimeHours->Visible = false;
                $this->lstCreatedDateTimeMinutes->Visible = false;
                $this->lstCreatedDateTimeHours->Refresh();
                $this->lstCreatedDateTimeMinutes->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = false;
                $this->lstAccount->Refresh();
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
            case 'TOKEN':
                $this->txtToken->Visible = true;
                $this->txtToken->Refresh();
                break;
            case 'CREATEDDATETIME':
                $this->txtCreatedDateTime->Visible = true;
                $this->txtCreatedDateTime->Refresh();
                break;
            case 'CREATEDDATETIMETIME':
                $this->lstCreatedDateTimeHours->Visible = true;
                $this->lstCreatedDateTimeMinutes->Visible = true;
                $this->lstCreatedDateTimeHours->Refresh();
                $this->lstCreatedDateTimeMinutes->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = true;
                $this->lstAccount->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtToken->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Account = null)  {
        if (!$this->Object)
            $this->Object = new PasswordReset();
        
        $this->Object->Token = $this->txtToken->Text;
        if (strlen($this->txtCreatedDateTime->Text) > 0) {
            if ($this->lstCreatedDateTimeHours->SelectedIndex > 0)
                $this->Object->CreatedDateTime = new QDateTime($this->txtCreatedDateTime->Text.' '.$this->lstCreatedDateTimeHours->SelectedValue.':'.$this->lstCreatedDateTimeMinutes->SelectedValue);
            else
                $this->Object->CreatedDateTime = new QDateTime($this->txtCreatedDateTime->Text);
        }
        if ($Account) {
            $this->Object->AccountObject = $Account;
        }
        if ($this->saveUsingLstAccount) {
            $linkedAccount = Account::Load($this->lstAccount->SelectedValue);
            $this->Object->AccountObject = $linkedAccount;
        }
    }

    public function saveObject($validate = true,$Account = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Account);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtToken);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtCreatedDateTime);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtToken->WrapperCssClass = 'form-group';
            $this->txtToken->Placeholder = '';
            $this->txtCreatedDateTime->WrapperCssClass = 'form-group';
            $this->txtCreatedDateTime->Placeholder = '';
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
            $previousValues = PasswordReset::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Token-> Value before: '.$previousValues->Token.', Value after: '.$this->Object->Token.'<br>
        CreatedDateTime-> Value before: '.$previousValues->CreatedDateTime.', Value after: '.$this->Object->CreatedDateTime.'<br>
        ';
        } else {
        $changeText = 'Token-> Value: '.$this->Object->Token.'<br>
        CreatedDateTime-> Value: '.$this->Object->CreatedDateTime.'<br>
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
            $AuditLogEntry->ObjectName = 'PasswordReset';
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
                $AuditLogEntry->ObjectName = 'PasswordReset';
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