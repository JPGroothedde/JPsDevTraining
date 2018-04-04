<?php
class PostController_Base {
    protected $Object;
    public $txtPostText;
    public $txtDateCreated;
    public $lstDateCreatedHours,$lstDateCreatedMinutes;
    public $lstAccount,$saveUsingLstAccount = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtPostText = new QTextBox($objParentObject);
        $this->txtPostText->Name = 'Post Text';

        $this->txtDateCreated = new QTextBox($objParentObject);
        $this->txtDateCreated->Name = 'Date Created';
        $this->txtDateCreated->CssClass = 'form-control input-date';

        $this->lstDateCreatedHours = new QListBox($objParentObject);
        $this->lstDateCreatedHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstDateCreatedMinutes = new QListBox($objParentObject);
        $this->lstDateCreatedMinutes->HtmlBefore = ' : ';
        $this->lstDateCreatedMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstDateCreatedHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstDateCreatedHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstDateCreatedMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstDateCreatedMinutes->AddItem(new QListItem($display,$i));
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
        $this->txtDateCreated->Text = '';
        $this->setDateCreatedTime();

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->PostText)) {
            $this->txtPostText->Text = $Object->PostText;
        }
        if (!is_null($Object->DateCreated)) {
            $this->txtDateCreated->Text = $Object->DateCreated->format(DATE_TIME_FORMAT_HTML);
            $this->setDateCreatedTime($Object->DateCreated);
        }
        
        if (!is_null($Object->AccountObject)) {
            $this->lstAccount->SelectedValue = $Object->AccountObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setDateCreatedTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstDateCreatedHours->SelectedIndex = 0;
            $this->lstDateCreatedMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstDateCreatedHours->SelectedValue = $time->format('H');
        $this->lstDateCreatedMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'POSTTEXT') {
            if (strlen($nameValue) > 0)
                $this->txtPostText->Name = $nameValue;
            $output = $withName ? $this->txtPostText->RenderWithName($blnPrintOutput):$this->txtPostText->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DATECREATED') {
            if (strlen($nameValue) > 0)
                $this->txtDateCreated->Name = $nameValue;
            $output = $withName ? $this->txtDateCreated->RenderWithName($blnPrintOutput):$this->txtDateCreated->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DATECREATEDTIME') {
            if ($withName) {
                $this->lstDateCreatedHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstDateCreatedHours->HtmlBefore = '';
            }
            $output = $this->lstDateCreatedHours->Render($blnPrintOutput);
            $output .= $this->lstDateCreatedMinutes->Render($blnPrintOutput);
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
        $this->renderControl('DATECREATED',$withName);
        $this->renderControl('DATECREATEDTIME',$withName);
        $this->renderControl('ACCOUNT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('PostText',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DateCreated',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DateCreatedTIME',$withName, 'Time', false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtPostText->Visible = false;
        $this->txtDateCreated->Visible = false;
        $this->lstDateCreatedHours->Visible = false;
        $this->lstDateCreatedMinutes->Visible = false;
        $this->lstAccount->Visible = false;
    }

    public function showAll() {
        $this->txtPostText->Visible = true;
        $this->txtDateCreated->Visible = true;
        $this->lstDateCreatedHours->Visible = true;
        $this->lstDateCreatedMinutes->Visible = true;
        $this->lstAccount->Visible = true;
    }

    public function refreshAll() {
        $this->txtPostText->Refresh();
        $this->txtDateCreated->Refresh();
        $this->lstDateCreatedHours->Refresh();
        $this->lstDateCreatedMinutes->Refresh();
        $this->lstAccount->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'POSTTEXT':
                $this->txtPostText->Text = $value;
                break;
            case 'DATECREATED':
                $this->txtDateCreated->Text = $value;
                break;
            case 'DATECREATEDTIME':
                $this->setDateCreatedTime($value);
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
            case 'DATECREATED':
                if ($this->txtDateCreated->Text)
                    return $this->txtDateCreated->Text;
                break;
            case 'DATECREATEDTIME':
                return $this->lstDateCreatedHours->SelectedValue.':'.$this->lstDateCreatedMinutes->SelectedValue;
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
            case 'DATECREATED':
                if ($this->txtDateCreated)
                    return $this->txtDateCreated->ControlId;
                break;
            case 'DATECREATEDHOURS':
                if ($this->lstDateCreatedHours)
                    return $this->lstDateCreatedHours->ControlId;
                break;
            case 'DATECREATEDMINUTES':
                if ($this->lstDateCreatedMinutes)
                    return $this->lstDateCreatedMinutes->ControlId;
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
            case 'DATECREATED':
                $this->txtDateCreated->Visible = false;
                $this->txtDateCreated->Refresh();
                break;
            case 'DATECREATEDTIME':
                $this->lstDateCreatedHours->Visible = false;
                $this->lstDateCreatedMinutes->Visible = false;
                $this->lstDateCreatedHours->Refresh();
                $this->lstDateCreatedMinutes->Refresh();
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
            case 'DATECREATED':
                $this->txtDateCreated->Visible = true;
                $this->txtDateCreated->Refresh();
                break;
            case 'DATECREATEDTIME':
                $this->lstDateCreatedHours->Visible = true;
                $this->lstDateCreatedMinutes->Visible = true;
                $this->lstDateCreatedHours->Refresh();
                $this->lstDateCreatedMinutes->Refresh();
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
        if (strlen($this->txtDateCreated->Text) > 0) {
            if ($this->lstDateCreatedHours->SelectedIndex > 0)
                $this->Object->DateCreated = new QDateTime($this->txtDateCreated->Text.' '.$this->lstDateCreatedHours->SelectedValue.':'.$this->lstDateCreatedMinutes->SelectedValue);
            else
                $this->Object->DateCreated = new QDateTime($this->txtDateCreated->Text);
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDateCreated);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtPostText->WrapperCssClass = 'form-group';
            $this->txtPostText->Placeholder = '';
            $this->txtDateCreated->WrapperCssClass = 'form-group';
            $this->txtDateCreated->Placeholder = '';
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
        DateCreated-> Value before: '.$previousValues->DateCreated.', Value after: '.$this->Object->DateCreated.'<br>
        ';
        } else {
        $changeText = 'PostText-> Value: '.$this->Object->PostText.'<br>
        DateCreated-> Value: '.$this->Object->DateCreated.'<br>
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