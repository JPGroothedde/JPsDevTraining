<?php
class TaskController_Base {
    protected $Object;
    public $txtName;
    public $txtDescription;
    public $txtDueDate;
    public $lstStatus;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtName = new QTextBox($objParentObject);
        $this->txtName->Name = 'Name';

        $this->txtDescription = new QTextBox($objParentObject);
        $this->txtDescription->Name = 'Description';

        $this->txtDueDate = new QTextBox($objParentObject);
        $this->txtDueDate->Name = 'Due Date';
        $this->txtDueDate->CssClass = 'form-control input-date';

        $this->lstStatus = new QListBox($objParentObject);
        $this->lstStatus->Name = 'Status';
        $this->lstStatus->DisplayStyle = QDisplayStyle::Block;
        $this->lstStatus->AddCssClass('fullWidth');

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
        $this->txtName->Text = '';
        $this->txtDescription->Text = '';
        $this->txtDueDate->Text = '';
        $this->lstStatus->RemoveAllItems();
        $this->lstStatus->AddItem(new QListItem('New','New'));
        $this->lstStatus->AddItem(new QListItem('In Progress','In Progress'));
        $this->lstStatus->AddItem(new QListItem('Done','Done'));
        

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->Name)
            $this->txtName->Text = $Object->Name;
        if ($Object->Description)
            $this->txtDescription->Text = $Object->Description;
        if ($Object->DueDate)
            $this->txtDueDate->Text = $Object->DueDate->format(DATE_TIME_FORMAT_HTML);
        if ($Object->Status)
            $this->lstStatus->SelectedValue = $Object->Status;
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'NAME') {
            if (strlen($nameValue) > 0)
                $this->txtName->Name = $nameValue;
            $output = $withName ? $this->txtName->RenderWithName($blnPrintOutput):$this->txtName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DESCRIPTION') {
            if (strlen($nameValue) > 0)
                $this->txtDescription->Name = $nameValue;
            $output = $withName ? $this->txtDescription->RenderWithName($blnPrintOutput):$this->txtDescription->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUEDATE') {
            if (strlen($nameValue) > 0)
                $this->txtDueDate->Name = $nameValue;
            $output = $withName ? $this->txtDueDate->RenderWithName($blnPrintOutput):$this->txtDueDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'STATUS') {
            if (strlen($nameValue) > 0)
                $this->lstStatus->Name = $nameValue;
            $output = $withName ? $this->lstStatus->RenderWithName($blnPrintOutput):$this->lstStatus->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('NAME',$withName);
        $this->renderControl('DESCRIPTION',$withName);
        $this->renderControl('DUEDATE',$withName);
        $this->renderControl('STATUS',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Name',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Description',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DueDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Status',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtName->Visible = false;
        $this->txtDescription->Visible = false;
        $this->txtDueDate->Visible = false;
        $this->lstStatus->Visible = false;
    }

    public function showAll() {
        $this->txtName->Visible = true;
        $this->txtDescription->Visible = true;
        $this->txtDueDate->Visible = true;
        $this->lstStatus->Visible = true;
    }

    public function refreshAll() {
        $this->txtName->Refresh();
        $this->txtDescription->Refresh();
        $this->txtDueDate->Refresh();
        $this->lstStatus->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch ($strAttr) {
            case '':
                break;
            case 'Name':
                $this->txtName->Text = $value;
                break;
            case 'Description':
                $this->txtDescription->Text = $value;
                break;
            case 'DueDate':
                $this->txtDueDate->Text = $value;
                break;
            case 'Status':
                $this->lstStatus->SelectedValue = $value;
                break;
            default:
                break;
        }
        return null;
    }


    public function getValue($strAttr = '') {
        switch ($strAttr) {
            case '':
                break;
            case 'Name':
                if ($this->txtName->Text)
                    return $this->txtName->Text;
                break;
            case 'Description':
                if ($this->txtDescription->Text)
                    return $this->txtDescription->Text;
                break;
            case 'DueDate':
                if ($this->txtDueDate->Text)
                    return $this->txtDueDate->Text;
                break;
            case 'Status':
                if ($this->lstStatus->SelectedValue)
                    return $this->lstStatus->SelectedValue;
                break;
            default:
                break;
        }
        return null;
    }


    public function getControlId($strAttr = '') {
        switch ($strAttr) {
            case '':
                break;
            case 'Name':
                if ($this->txtName)
                    return $this->txtName->ControlId;
                break;
            case 'Description':
                if ($this->txtDescription)
                    return $this->txtDescription->ControlId;
                break;
            case 'DueDate':
                if ($this->txtDueDate)
                    return $this->txtDueDate->ControlId;
                break;
            case 'Status':
                if ($this->lstStatus)
                    return $this->lstStatus->ControlId;
                break;
            default:
                break;
        }
        return null;
    }


    public function hideControl($strAttr = '') {
        switch ($strAttr) {
            case '':
                break;
            case 'Name':
                $this->txtName->Visible = false;
                $this->txtName->Refresh();
                break;
            case 'Description':
                $this->txtDescription->Visible = false;
                $this->txtDescription->Refresh();
                break;
            case 'DueDate':
                $this->txtDueDate->Visible = false;
                $this->txtDueDate->Refresh();
                break;
            case 'Status':
                $this->lstStatus->Visible = false;
                $this->lstStatus->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function showControl($strAttr = '') {
        switch ($strAttr) {
            case '':
                break;
            case 'Name':
                $this->txtName->Visible = true;
                $this->txtName->Refresh();
                break;
            case 'Description':
                $this->txtDescription->Visible = true;
                $this->txtDescription->Refresh();
                break;
            case 'DueDate':
                $this->txtDueDate->Visible = true;
                $this->txtDueDate->Refresh();
                break;
            case 'Status':
                $this->lstStatus->Visible = true;
                $this->lstStatus->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtName->getJqControlId();
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
            $this->Object = new Task();
        
        $this->Object->Name = $this->txtName->Text;
        $this->Object->Description = $this->txtDescription->Text;
        if (strlen($this->txtDueDate->Text) > 0)
            $this->Object->DueDate = new QDateTime($this->txtDueDate->Text);
        $this->Object->Status = $this->lstStatus->SelectedValue;
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
        $this->resetValidation();
        // Example of validating a field as required
        /*if (!(strlen($this->txtName->Text) > 0)){
            $this->txtName->WrapperCssClass = 'form-group has-error';
            $this->txtName->Placeholder = 'Name is required.';
            $this->txtName->Text = '';
            $this->txtName->Blink();
            $this->txtName->Refresh();
            $this->txtName->Focus();
            $hasNoErrors = false;
        }*/
        // Example of validating a field as required
        /*if (!(strlen($this->txtDescription->Text) > 0)){
            $this->txtDescription->WrapperCssClass = 'form-group has-error';
            $this->txtDescription->Placeholder = 'Description is required.';
            $this->txtDescription->Text = '';
            $this->txtDescription->Blink();
            $this->txtDescription->Refresh();
            $this->txtDescription->Focus();
            $hasNoErrors = false;
        }*/
        // Example of validating a field as required
        /*if (!(strlen($this->txtDueDate->Text) > 0)){
            $this->txtDueDate->WrapperCssClass = 'form-group has-error';
            $this->txtDueDate->Placeholder = 'Due Date is required.';
            $this->txtDueDate->Text = '';
            $this->txtDueDate->Blink();
            $this->txtDueDate->Refresh();
            $this->txtDueDate->Focus();
            $hasNoErrors = false;
        }*/
        // Example of validating a field as required
        /*if (!$this->lstStatus->SelectedValue){
            $this->lstStatus->WrapperCssClass = 'form-group has-error';
            $this->lstStatus->Blink();
            $this->lstStatus->Refresh();
            $this->lstStatus->Focus();
            $hasNoErrors = false;
        }*/
        // Example of validating an email address
        /*if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $this->txtTaskFIELD-->Text)){
            $this->txtTaskFIELD->WrapperCssClass = 'form-group has-error';
            $this->txtTaskFIELD->Placeholder = 'Invalid Email.';
            $this->txtTaskFIELD->Text = '';
            $this->txtTaskFIELD->Blink();
            $this->txtTaskFIELD->Refresh();
            $this->txtTaskFIELD->Focus();
            $hasNoErrors = false;
        };*/
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtName->WrapperCssClass = 'form-group';
            $this->txtName->Placeholder = '';
            $this->txtDescription->WrapperCssClass = 'form-group';
            $this->txtDescription->Placeholder = '';
            $this->txtDueDate->WrapperCssClass = 'form-group';
            $this->txtDueDate->Placeholder = '';
            $this->lstStatus->WrapperCssClass = 'form-group';
        $js = AppSpecificFunctions::GetDatePickerInitJs();
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    public function saveWithAudit() {
        if ($this->Object)
            $previousValues = Task::Load($this->Object->Id);
        $currentUserInfo = 'Anonymous';
        if (getCurrentAccount())
            $currentUserInfo = getCurrentAccount()->EmailAddress;
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Name-> Value before: '.$previousValues->Name.', Value after: '.$this->Object->Name.'<br>
        Description-> Value before: '.$previousValues->Description.', Value after: '.$this->Object->Description.'<br>
        DueDate-> Value before: '.$previousValues->DueDate.', Value after: '.$this->Object->DueDate.'<br>
        Status-> Value before: '.$previousValues->Status.', Value after: '.$this->Object->Status.'<br>
        ';
        } else {
        $changeText = 'Name-> Value: '.$this->Object->Name.'<br>
        Description-> Value: '.$this->Object->Description.'<br>
        DueDate-> Value: '.$this->Object->DueDate.'<br>
        Status-> Value: '.$this->Object->Status.'<br>
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
            $AuditLogEntry->ObjectName = 'Task';
            $AuditLogEntry->UserEmail = $currentUserInfo;
            $AuditLogEntry->AuditLogEntryDetail = $changeText;
            $AuditLogEntry->Save();

            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            AppSpecificFunctions::DisplayAlert('Could not save right now. Please try again later...');
            return false;
        }
    }

    public function deleteWithAudit() {
        if ($this->Object){
            try {
                $AuditLogEntry = new AuditLogEntry();
                $AuditLogEntry->EntryTimeStamp = QDateTime::Now(true);
                $AuditLogEntry->ModificationType = 'Delete';
                $AuditLogEntry->ObjectName = 'Task';
                $AuditLogEntry->UserEmail = getCurrentAccount()->EmailAddress;
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
    }

    
};
?>