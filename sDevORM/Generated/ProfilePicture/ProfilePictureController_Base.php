<?php
class ProfilePictureController_Base {
    protected $Object;
    public $txtProfilePicturePath;
    public $lstAccount,$saveUsingLstAccount = false;
    public $lstFileDocument,$saveUsingLstFileDocument = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtProfilePicturePath = new QTextBox($objParentObject);
        $this->txtProfilePicturePath->Name = 'Profile Picture Path';

        $this->lstAccount = new QListBox($objParentObject);
        $this->lstAccount->Name = 'Account';
        $this->lstAccount->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allAccount = Account::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allAccount as $Account) {
            $this->lstAccount->AddItem(new QListItem($Account->Id,$Account->Id));
        }

        $this->lstFileDocument = new QListBox($objParentObject);
        $this->lstFileDocument->Name = 'File Document';
        $this->lstFileDocument->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allFileDocument = FileDocument::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allFileDocument as $FileDocument) {
            $this->lstFileDocument->AddItem(new QListItem($FileDocument->Id,$FileDocument->Id));
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
            if ($ReferenceObject == 'FileDocument') {
                $this->lstFileDocument->RemoveAllItems();
                $allFileDocument_list = FileDocument::LoadAll();
                foreach ($allFileDocument_list as $FileDocument) {
                    $this->lstFileDocument->AddItem(new QListItem($FileDocument->__get($ReferenceAttribute),$FileDocument->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Account') {
                $this->saveUsingLstAccount = $useListValue;
            }
            if ($ReferenceObject == 'FileDocument') {
                $this->saveUsingLstFileDocument = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtProfilePicturePath->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->ProfilePicturePath)) {
            $this->txtProfilePicturePath->Text = $Object->ProfilePicturePath;
        }
        
        if (!is_null($Object->AccountObject)) {
            $this->lstAccount->SelectedValue = $Object->AccountObject->Id;
        }
        if (!is_null($Object->FileDocumentObject)) {
            $this->lstFileDocument->SelectedValue = $Object->FileDocumentObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'PROFILEPICTUREPATH') {
            if (strlen($nameValue) > 0)
                $this->txtProfilePicturePath->Name = $nameValue;
            $output = $withName ? $this->txtProfilePicturePath->RenderWithName($blnPrintOutput):$this->txtProfilePicturePath->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ACCOUNT') {
            if (strlen($nameValue) > 0)
                $this->lstAccount->Name = $nameValue;
            $output = $withName ? $this->lstAccount->RenderWithName($blnPrintOutput):$this->lstAccount->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'FILEDOCUMENT') {
            if (strlen($nameValue) > 0)
                $this->lstFileDocument->Name = $nameValue;
            $output = $withName ? $this->lstFileDocument->RenderWithName($blnPrintOutput):$this->lstFileDocument->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('PROFILEPICTUREPATH',$withName);
        $this->renderControl('ACCOUNT',$withName);
        $this->renderControl('FILEDOCUMENT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('ProfilePicturePath',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtProfilePicturePath->Visible = false;
        $this->lstAccount->Visible = false;
        $this->lstFileDocument->Visible = false;
    }

    public function showAll() {
        $this->txtProfilePicturePath->Visible = true;
        $this->lstAccount->Visible = true;
        $this->lstFileDocument->Visible = true;
    }

    public function refreshAll() {
        $this->txtProfilePicturePath->Refresh();
        $this->lstAccount->Refresh();
        $this->lstFileDocument->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'PROFILEPICTUREPATH':
                $this->txtProfilePicturePath->Text = $value;
                break;
            case 'ACCOUNT':
                $this->lstAccount->SelectedValue = $value;
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->SelectedValue = $value;
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
            case 'PROFILEPICTUREPATH':
                if ($this->txtProfilePicturePath->Text)
                    return $this->txtProfilePicturePath->Text;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount->SelectedValue)
                    return $this->lstAccount->SelectedValue;
                break;
            case 'FILEDOCUMENT':
                if ($this->lstFileDocument->SelectedValue)
                    return $this->lstFileDocument->SelectedValue;
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
            case 'PROFILEPICTUREPATH':
                if ($this->txtProfilePicturePath)
                    return $this->txtProfilePicturePath->ControlId;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount)
                    return $this->lstAccount->ControlId;
                break;
            case 'FILEDOCUMENT':
                if ($this->lstFileDocument)
                    return $this->lstFileDocument->ControlId;
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
            case 'PROFILEPICTUREPATH':
                $this->txtProfilePicturePath->Visible = false;
                $this->txtProfilePicturePath->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = false;
                $this->lstAccount->Refresh();
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->Visible = false;
                $this->lstFileDocument->Refresh();
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
            case 'PROFILEPICTUREPATH':
                $this->txtProfilePicturePath->Visible = true;
                $this->txtProfilePicturePath->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = true;
                $this->lstAccount->Refresh();
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->Visible = true;
                $this->lstFileDocument->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtProfilePicturePath->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Account = null,$FileDocument = null)  {
        if (!$this->Object)
            $this->Object = new ProfilePicture();
        
        $this->Object->ProfilePicturePath = $this->txtProfilePicturePath->Text;
        if ($Account) {
            $this->Object->AccountObject = $Account;
        }
        if ($this->saveUsingLstAccount) {
            $linkedAccount = Account::Load($this->lstAccount->SelectedValue);
            $this->Object->AccountObject = $linkedAccount;
        }
        if ($FileDocument) {
            $this->Object->FileDocumentObject = $FileDocument;
        }
        if ($this->saveUsingLstFileDocument) {
            $linkedFileDocument = FileDocument::Load($this->lstFileDocument->SelectedValue);
            $this->Object->FileDocumentObject = $linkedFileDocument;
        }
    }

    public function saveObject($validate = true,$Account = null,$FileDocument = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Account,$FileDocument);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtProfilePicturePath);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtProfilePicturePath->WrapperCssClass = 'form-group';
            $this->txtProfilePicturePath->Placeholder = '';
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
            $previousValues = ProfilePicture::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'ProfilePicturePath-> Value before: '.$previousValues->ProfilePicturePath.', Value after: '.$this->Object->ProfilePicturePath.'<br>
        ';
        } else {
        $changeText = 'ProfilePicturePath-> Value: '.$this->Object->ProfilePicturePath.'<br>
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
            $AuditLogEntry->ObjectName = 'ProfilePicture';
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
                $AuditLogEntry->ObjectName = 'ProfilePicture';
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