<?php
class PostController_Base {
    protected $Object;
    public $txtPostText;
    public $txtPostTimeStamp;
    public $lstPostTimeStampHours,$lstPostTimeStampMinutes;
    public $lstAccount,$saveUsingLstAccount = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtPostText = new QTextBox($objParentObject);
        $this->txtPostText->Name = 'Post Text';

        $this->txtPostTimeStamp = new QTextBox($objParentObject);
        $this->txtPostTimeStamp->Name = 'Post Time Stamp';
        $this->txtPostTimeStamp->CssClass = 'form-control input-date';

        $this->lstPostTimeStampHours = new QListBox($objParentObject);
        $this->lstPostTimeStampHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstPostTimeStampMinutes = new QListBox($objParentObject);
        $this->lstPostTimeStampMinutes->HtmlBefore = ' : ';
        $this->lstPostTimeStampMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstPostTimeStampHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstPostTimeStampHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstPostTimeStampMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstPostTimeStampMinutes->AddItem(new QListItem($display,$i));
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
        $this->txtPostText->Text = '';
        $this->txtPostTimeStamp->Text = '';
        $this->setPostTimeStampTime();

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->PostText)) {
            $this->txtPostText->Text = $Object->PostText;
        }
        if (!is_null($Object->PostTimeStamp)) {
            $this->txtPostTimeStamp->Text = $Object->PostTimeStamp->format(DATE_TIME_FORMAT_HTML);
            $this->setPostTimeStampTime($Object->PostTimeStamp);
        }
        
        if (!is_null($Object->AccountObject)) {
            $this->lstAccount->SelectedValue = $Object->AccountObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setPostTimeStampTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstPostTimeStampHours->SelectedIndex = 0;
            $this->lstPostTimeStampMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstPostTimeStampHours->SelectedValue = $time->format('H');
        $this->lstPostTimeStampMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'POSTTEXT') {
            if (strlen($nameValue) > 0)
                $this->txtPostText->Name = $nameValue;
            $output = $withName ? $this->txtPostText->RenderWithName($blnPrintOutput):$this->txtPostText->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'POSTTIMESTAMP') {
            if (strlen($nameValue) > 0)
                $this->txtPostTimeStamp->Name = $nameValue;
            $output = $withName ? $this->txtPostTimeStamp->RenderWithName($blnPrintOutput):$this->txtPostTimeStamp->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'POSTTIMESTAMPTIME') {
            if ($withName) {
                $this->lstPostTimeStampHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstPostTimeStampHours->HtmlBefore = '';
            }
            $output = $this->lstPostTimeStampHours->Render($blnPrintOutput);
            $output .= $this->lstPostTimeStampMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ACCOUNT') {
            if (strlen($nameValue) > 0)
                $this->lstAccount->Name = $nameValue;
            $output = $withName ? $this->lstAccount->RenderWithName($blnPrintOutput):$this->lstAccount->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('POSTTEXT',$withName);
        $this->renderControl('POSTTIMESTAMP',$withName);
        $this->renderControl('POSTTIMESTAMPTIME',$withName);
        $this->renderControl('ACCOUNT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('PostText',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('PostTimeStamp',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('PostTimeStampTIME',$withName, 'Time', false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtPostText->Visible = false;
        $this->txtPostTimeStamp->Visible = false;
        $this->lstPostTimeStampHours->Visible = false;
        $this->lstPostTimeStampMinutes->Visible = false;
        $this->lstAccount->Visible = false;
    }

    public function showAll() {
        $this->txtPostText->Visible = true;
        $this->txtPostTimeStamp->Visible = true;
        $this->lstPostTimeStampHours->Visible = true;
        $this->lstPostTimeStampMinutes->Visible = true;
        $this->lstAccount->Visible = true;
    }

    public function refreshAll() {
        $this->txtPostText->Refresh();
        $this->txtPostTimeStamp->Refresh();
        $this->lstPostTimeStampHours->Refresh();
        $this->lstPostTimeStampMinutes->Refresh();
        $this->lstAccount->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'POSTTEXT':
                $this->txtPostText->Text = $value;
                break;
            case 'POSTTIMESTAMP':
                $this->txtPostTimeStamp->Text = $value;
                break;
            case 'POSTTIMESTAMPTIME':
                $this->setPostTimeStampTime($value);
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
            case 'POSTTEXT':
                if ($this->txtPostText->Text)
                    return $this->txtPostText->Text;
                break;
            case 'POSTTIMESTAMP':
                if ($this->txtPostTimeStamp->Text)
                    return $this->txtPostTimeStamp->Text;
                break;
            case 'POSTTIMESTAMPTIME':
                return $this->lstPostTimeStampHours->SelectedValue.':'.$this->lstPostTimeStampMinutes->SelectedValue;
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
            case 'POSTTEXT':
                if ($this->txtPostText)
                    return $this->txtPostText->ControlId;
                break;
            case 'POSTTIMESTAMP':
                if ($this->txtPostTimeStamp)
                    return $this->txtPostTimeStamp->ControlId;
                break;
            case 'POSTTIMESTAMPHOURS':
                if ($this->lstPostTimeStampHours)
                    return $this->lstPostTimeStampHours->ControlId;
                break;
            case 'POSTTIMESTAMPMINUTES':
                if ($this->lstPostTimeStampMinutes)
                    return $this->lstPostTimeStampMinutes->ControlId;
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
            case 'POSTTEXT':
                $this->txtPostText->Visible = false;
                $this->txtPostText->Refresh();
                break;
            case 'POSTTIMESTAMP':
                $this->txtPostTimeStamp->Visible = false;
                $this->txtPostTimeStamp->Refresh();
                break;
            case 'POSTTIMESTAMPTIME':
                $this->lstPostTimeStampHours->Visible = false;
                $this->lstPostTimeStampMinutes->Visible = false;
                $this->lstPostTimeStampHours->Refresh();
                $this->lstPostTimeStampMinutes->Refresh();
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
            case 'POSTTEXT':
                $this->txtPostText->Visible = true;
                $this->txtPostText->Refresh();
                break;
            case 'POSTTIMESTAMP':
                $this->txtPostTimeStamp->Visible = true;
                $this->txtPostTimeStamp->Refresh();
                break;
            case 'POSTTIMESTAMPTIME':
                $this->lstPostTimeStampHours->Visible = true;
                $this->lstPostTimeStampMinutes->Visible = true;
                $this->lstPostTimeStampHours->Refresh();
                $this->lstPostTimeStampMinutes->Refresh();
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
        return $this->txtPostText->getJqControlId();
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
            $this->Object = new Post();
        
        $this->Object->PostText = $this->txtPostText->Text;
        if (strlen($this->txtPostTimeStamp->Text) > 0) {
            if ($this->lstPostTimeStampHours->SelectedIndex > 0)
                $this->Object->PostTimeStamp = new QDateTime($this->txtPostTimeStamp->Text.' '.$this->lstPostTimeStampHours->SelectedValue.':'.$this->lstPostTimeStampMinutes->SelectedValue);
            else
                $this->Object->PostTimeStamp = new QDateTime($this->txtPostTimeStamp->Text);
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPostText);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPostTimeStamp);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtPostText->WrapperCssClass = 'form-group';
            $this->txtPostText->Placeholder = '';
            $this->txtPostTimeStamp->WrapperCssClass = 'form-group';
            $this->txtPostTimeStamp->Placeholder = '';
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
            $previousValues = Post::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'PostText-> Value before: '.$previousValues->PostText.', Value after: '.$this->Object->PostText.'<br>
        PostTimeStamp-> Value before: '.$previousValues->PostTimeStamp.', Value after: '.$this->Object->PostTimeStamp.'<br>
        ';
        } else {
        $changeText = 'PostText-> Value: '.$this->Object->PostText.'<br>
        PostTimeStamp-> Value: '.$this->Object->PostTimeStamp.'<br>
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
            $AuditLogEntry->ObjectName = 'Post';
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
                $AuditLogEntry->ObjectName = 'Post';
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