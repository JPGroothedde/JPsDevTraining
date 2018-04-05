<?php
class AssignmentController_Base {
    protected $Object;
    public $txtName;
    public $txtStatus;
    public $txtFinalMark;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtName = new QTextBox($objParentObject);
        $this->txtName->Name = 'Name';

        $this->txtStatus = new QTextBox($objParentObject);
        $this->txtStatus->Name = 'Status';

        $this->txtFinalMark = new QTextBox($objParentObject);
        $this->txtFinalMark->Name = 'Final Mark';

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
        $this->txtStatus->Text = '';
        $this->txtFinalMark->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->Name)) {
            $this->txtName->Text = $Object->Name;
        }
        if (!is_null($Object->Status)) {
            $this->txtStatus->Text = $Object->Status;
        }
        if (!is_null($Object->FinalMark)) {
            $this->txtFinalMark->Text = $Object->FinalMark;
        }
        

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
        if (strtoupper($strControl) == 'STATUS') {
            if (strlen($nameValue) > 0)
                $this->txtStatus->Name = $nameValue;
            $output = $withName ? $this->txtStatus->RenderWithName($blnPrintOutput):$this->txtStatus->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'FINALMARK') {
            if (strlen($nameValue) > 0)
                $this->txtFinalMark->Name = $nameValue;
            $output = $withName ? $this->txtFinalMark->RenderWithName($blnPrintOutput):$this->txtFinalMark->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('NAME',$withName);
        $this->renderControl('STATUS',$withName);
        $this->renderControl('FINALMARK',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Name',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Status',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('FinalMark',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtName->Visible = false;
        $this->txtStatus->Visible = false;
        $this->txtFinalMark->Visible = false;
    }

    public function showAll() {
        $this->txtName->Visible = true;
        $this->txtStatus->Visible = true;
        $this->txtFinalMark->Visible = true;
    }

    public function refreshAll() {
        $this->txtName->Refresh();
        $this->txtStatus->Refresh();
        $this->txtFinalMark->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'NAME':
                $this->txtName->Text = $value;
                break;
            case 'STATUS':
                $this->txtStatus->Text = $value;
                break;
            case 'FINALMARK':
                $this->txtFinalMark->Text = $value;
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
            case 'NAME':
                if ($this->txtName->Text)
                    return $this->txtName->Text;
                break;
            case 'STATUS':
                if ($this->txtStatus->Text)
                    return $this->txtStatus->Text;
                break;
            case 'FINALMARK':
                if ($this->txtFinalMark->Text)
                    return $this->txtFinalMark->Text;
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
            case 'NAME':
                if ($this->txtName)
                    return $this->txtName->ControlId;
                break;
            case 'STATUS':
                if ($this->txtStatus)
                    return $this->txtStatus->ControlId;
                break;
            case 'FINALMARK':
                if ($this->txtFinalMark)
                    return $this->txtFinalMark->ControlId;
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
            case 'NAME':
                $this->txtName->Visible = false;
                $this->txtName->Refresh();
                break;
            case 'STATUS':
                $this->txtStatus->Visible = false;
                $this->txtStatus->Refresh();
                break;
            case 'FINALMARK':
                $this->txtFinalMark->Visible = false;
                $this->txtFinalMark->Refresh();
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
            case 'NAME':
                $this->txtName->Visible = true;
                $this->txtName->Refresh();
                break;
            case 'STATUS':
                $this->txtStatus->Visible = true;
                $this->txtStatus->Refresh();
                break;
            case 'FINALMARK':
                $this->txtFinalMark->Visible = true;
                $this->txtFinalMark->Refresh();
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
            $this->Object = new Assignment();
        
        $this->Object->Name = $this->txtName->Text;
        $this->Object->Status = $this->txtStatus->Text;
        $this->Object->FinalMark = $this->txtFinalMark->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtStatus);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFinalMark);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtName->WrapperCssClass = 'form-group';
            $this->txtName->Placeholder = '';
            $this->txtStatus->WrapperCssClass = 'form-group';
            $this->txtStatus->Placeholder = '';
            $this->txtFinalMark->WrapperCssClass = 'form-group';
            $this->txtFinalMark->Placeholder = '';
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
            $previousValues = Assignment::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Name-> Value before: '.$previousValues->Name.', Value after: '.$this->Object->Name.'<br>
        Status-> Value before: '.$previousValues->Status.', Value after: '.$this->Object->Status.'<br>
        FinalMark-> Value before: '.$previousValues->FinalMark.', Value after: '.$this->Object->FinalMark.'<br>
        ';
        } else {
        $changeText = 'Name-> Value: '.$this->Object->Name.'<br>
        Status-> Value: '.$this->Object->Status.'<br>
        FinalMark-> Value: '.$this->Object->FinalMark.'<br>
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
            $AuditLogEntry->ObjectName = 'Assignment';
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
                $AuditLogEntry->ObjectName = 'Assignment';
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