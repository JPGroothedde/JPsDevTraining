<?php
class EmailTemplateContentRowController_Base {
    protected $Object;
    public $txtColumns;
    public $txtRowOrder;
    public $lstEmailTemplate,$saveUsingLstEmailTemplate = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtColumns = new QTextBox($objParentObject);
        $this->txtColumns->Name = 'Columns';
        $this->txtColumns->TextMode = QTextMode::Number;

        $this->txtRowOrder = new QTextBox($objParentObject);
        $this->txtRowOrder->Name = 'Row Order';
        $this->txtRowOrder->TextMode = QTextMode::Number;

        $this->lstEmailTemplate = new QListBox($objParentObject);
        $this->lstEmailTemplate->Name = 'Email Template';
        $this->lstEmailTemplate->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allEmailTemplate = EmailTemplate::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allEmailTemplate as $EmailTemplate) {
            $this->lstEmailTemplate->AddItem(new QListItem($EmailTemplate->Id,$EmailTemplate->Id));
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
            if ($ReferenceObject == 'EmailTemplate') {
                $this->lstEmailTemplate->RemoveAllItems();
                $allEmailTemplate_list = EmailTemplate::LoadAll();
                foreach ($allEmailTemplate_list as $EmailTemplate) {
                    $this->lstEmailTemplate->AddItem(new QListItem($EmailTemplate->__get($ReferenceAttribute),$EmailTemplate->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'EmailTemplate') {
                $this->saveUsingLstEmailTemplate = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtColumns->Text = '';
        $this->txtRowOrder->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->Columns)) {
            $this->txtColumns->Text = $Object->Columns;
        }
        if (!is_null($Object->RowOrder)) {
            $this->txtRowOrder->Text = $Object->RowOrder;
        }
        
        if (!is_null($Object->EmailTemplateObject)) {
            $this->lstEmailTemplate->SelectedValue = $Object->EmailTemplateObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'COLUMNS') {
            if (strlen($nameValue) > 0)
                $this->txtColumns->Name = $nameValue;
            $output = $withName ? $this->txtColumns->RenderWithName($blnPrintOutput):$this->txtColumns->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ROWORDER') {
            if (strlen($nameValue) > 0)
                $this->txtRowOrder->Name = $nameValue;
            $output = $withName ? $this->txtRowOrder->RenderWithName($blnPrintOutput):$this->txtRowOrder->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'EMAILTEMPLATE') {
            if (strlen($nameValue) > 0)
                $this->lstEmailTemplate->Name = $nameValue;
            $output = $withName ? $this->lstEmailTemplate->RenderWithName($blnPrintOutput):$this->lstEmailTemplate->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('COLUMNS',$withName);
        $this->renderControl('ROWORDER',$withName);
        $this->renderControl('EMAILTEMPLATE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Columns',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('RowOrder',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtColumns->Visible = false;
        $this->txtRowOrder->Visible = false;
        $this->lstEmailTemplate->Visible = false;
    }

    public function showAll() {
        $this->txtColumns->Visible = true;
        $this->txtRowOrder->Visible = true;
        $this->lstEmailTemplate->Visible = true;
    }

    public function refreshAll() {
        $this->txtColumns->Refresh();
        $this->txtRowOrder->Refresh();
        $this->lstEmailTemplate->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'COLUMNS':
                $this->txtColumns->Text = $value;
                break;
            case 'ROWORDER':
                $this->txtRowOrder->Text = $value;
                break;
            case 'EMAILTEMPLATE':
                $this->lstEmailTemplate->SelectedValue = $value;
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
            case 'COLUMNS':
                if ($this->txtColumns->Text)
                    return $this->txtColumns->Text;
                break;
            case 'ROWORDER':
                if ($this->txtRowOrder->Text)
                    return $this->txtRowOrder->Text;
                break;
            case 'EMAILTEMPLATE':
                if ($this->lstEmailTemplate->SelectedValue)
                    return $this->lstEmailTemplate->SelectedValue;
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
            case 'COLUMNS':
                if ($this->txtColumns)
                    return $this->txtColumns->ControlId;
                break;
            case 'ROWORDER':
                if ($this->txtRowOrder)
                    return $this->txtRowOrder->ControlId;
                break;
            case 'EMAILTEMPLATE':
                if ($this->lstEmailTemplate)
                    return $this->lstEmailTemplate->ControlId;
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
            case 'COLUMNS':
                $this->txtColumns->Visible = false;
                $this->txtColumns->Refresh();
                break;
            case 'ROWORDER':
                $this->txtRowOrder->Visible = false;
                $this->txtRowOrder->Refresh();
                break;
            case 'EMAILTEMPLATE':
                $this->lstEmailTemplate->Visible = false;
                $this->lstEmailTemplate->Refresh();
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
            case 'COLUMNS':
                $this->txtColumns->Visible = true;
                $this->txtColumns->Refresh();
                break;
            case 'ROWORDER':
                $this->txtRowOrder->Visible = true;
                $this->txtRowOrder->Refresh();
                break;
            case 'EMAILTEMPLATE':
                $this->lstEmailTemplate->Visible = true;
                $this->lstEmailTemplate->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtColumns->getJqControlId();
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

    public function applyValuesBeforeSaveObject($EmailTemplate = null)  {
        if (!$this->Object)
            $this->Object = new EmailTemplateContentRow();
        
        $this->Object->Columns = $this->txtColumns->Text;
        $this->Object->RowOrder = $this->txtRowOrder->Text;
        if ($EmailTemplate) {
            $this->Object->EmailTemplateObject = $EmailTemplate;
        }
        if ($this->saveUsingLstEmailTemplate) {
            $linkedEmailTemplate = EmailTemplate::Load($this->lstEmailTemplate->SelectedValue);
            $this->Object->EmailTemplateObject = $linkedEmailTemplate;
        }
    }

    public function saveObject($validate = true,$EmailTemplate = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($EmailTemplate);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtColumns);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtRowOrder);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtColumns->WrapperCssClass = 'form-group';
            $this->txtColumns->Placeholder = '';
            $this->txtRowOrder->WrapperCssClass = 'form-group';
            $this->txtRowOrder->Placeholder = '';
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
            $previousValues = EmailTemplateContentRow::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Columns-> Value before: '.$previousValues->Columns.', Value after: '.$this->Object->Columns.'<br>
        RowOrder-> Value before: '.$previousValues->RowOrder.', Value after: '.$this->Object->RowOrder.'<br>
        ';
        } else {
        $changeText = 'Columns-> Value: '.$this->Object->Columns.'<br>
        RowOrder-> Value: '.$this->Object->RowOrder.'<br>
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
            $AuditLogEntry->ObjectName = 'EmailTemplateContentRow';
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
                $AuditLogEntry->ObjectName = 'EmailTemplateContentRow';
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