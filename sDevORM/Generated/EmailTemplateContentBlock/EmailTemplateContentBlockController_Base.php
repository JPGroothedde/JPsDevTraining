<?php
class EmailTemplateContentBlockController_Base {
    protected $Object;
    public $txtContentBlock;
    public $lstContentType;
    public $txtPosition;
    public $lstEmailTemplateContentRow,$saveUsingLstEmailTemplateContentRow = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtContentBlock = new QTextBox($objParentObject);
        $this->txtContentBlock->Name = 'Content Block';

        $this->lstContentType = new QListBox($objParentObject);
        $this->lstContentType->Name = 'Content Type';
        $this->lstContentType->DisplayStyle = QDisplayStyle::Block;
        $this->lstContentType->AddCssClass('fullWidth');

        $this->txtPosition = new QTextBox($objParentObject);
        $this->txtPosition->Name = 'Position';

        $this->lstEmailTemplateContentRow = new QListBox($objParentObject);
        $this->lstEmailTemplateContentRow->Name = 'Email Template Content Row';
        $this->lstEmailTemplateContentRow->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allEmailTemplateContentRow = EmailTemplateContentRow::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allEmailTemplateContentRow as $EmailTemplateContentRow) {
            $this->lstEmailTemplateContentRow->AddItem(new QListItem($EmailTemplateContentRow->Id,$EmailTemplateContentRow->Id));
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
            if ($ReferenceObject == 'EmailTemplateContentRow') {
                $this->lstEmailTemplateContentRow->RemoveAllItems();
                $allEmailTemplateContentRow_list = EmailTemplateContentRow::LoadAll();
                foreach ($allEmailTemplateContentRow_list as $EmailTemplateContentRow) {
                    $this->lstEmailTemplateContentRow->AddItem(new QListItem($EmailTemplateContentRow->__get($ReferenceAttribute),$EmailTemplateContentRow->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'EmailTemplateContentRow') {
                $this->saveUsingLstEmailTemplateContentRow = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtContentBlock->Text = '';
        $this->lstContentType->RemoveAllItems();
        $this->lstContentType->AddItem(new QListItem('Text','Text'));
        $this->lstContentType->AddItem(new QListItem('Image','Image'));
        
        $this->txtPosition->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->ContentBlock) {
            $this->txtContentBlock->Text = $Object->ContentBlock;
        }
        if ($Object->ContentType) {
            $this->lstContentType->SelectedValue = $Object->ContentType;
        }
        if ($Object->Position) {
            $this->txtPosition->Text = $Object->Position;
        }
        
        if ($Object->EmailTemplateContentRowObject) {
            $this->lstEmailTemplateContentRow->SelectedValue = $Object->EmailTemplateContentRowObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'CONTENTBLOCK') {
            if (strlen($nameValue) > 0)
                $this->txtContentBlock->Name = $nameValue;
            $output = $withName ? $this->txtContentBlock->RenderWithName($blnPrintOutput):$this->txtContentBlock->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CONTENTTYPE') {
            if (strlen($nameValue) > 0)
                $this->lstContentType->Name = $nameValue;
            $output = $withName ? $this->lstContentType->RenderWithName($blnPrintOutput):$this->lstContentType->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'POSITION') {
            if (strlen($nameValue) > 0)
                $this->txtPosition->Name = $nameValue;
            $output = $withName ? $this->txtPosition->RenderWithName($blnPrintOutput):$this->txtPosition->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'EMAILTEMPLATECONTENTROW') {
            if (strlen($nameValue) > 0)
                $this->lstEmailTemplateContentRow->Name = $nameValue;
            $output = $withName ? $this->lstEmailTemplateContentRow->RenderWithName($blnPrintOutput):$this->lstEmailTemplateContentRow->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('CONTENTBLOCK',$withName);
        $this->renderControl('CONTENTTYPE',$withName);
        $this->renderControl('POSITION',$withName);
        $this->renderControl('EMAILTEMPLATECONTENTROW',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('ContentBlock',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('ContentType',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Position',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtContentBlock->Visible = false;
        $this->lstContentType->Visible = false;
        $this->txtPosition->Visible = false;
        $this->lstEmailTemplateContentRow->Visible = false;
    }

    public function showAll() {
        $this->txtContentBlock->Visible = true;
        $this->lstContentType->Visible = true;
        $this->txtPosition->Visible = true;
        $this->lstEmailTemplateContentRow->Visible = true;
    }

    public function refreshAll() {
        $this->txtContentBlock->Refresh();
        $this->lstContentType->Refresh();
        $this->txtPosition->Refresh();
        $this->lstEmailTemplateContentRow->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'CONTENTBLOCK':
                $this->txtContentBlock->Text = $value;
                break;
            case 'CONTENTTYPE':
                $this->lstContentType->SelectedValue = $value;
                break;
            case 'POSITION':
                $this->txtPosition->Text = $value;
                break;
            case 'EMAILTEMPLATECONTENTROW':
                $this->lstEmailTemplateContentRow->SelectedValue = $value;
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
            case 'CONTENTBLOCK':
                if ($this->txtContentBlock->Text)
                    return $this->txtContentBlock->Text;
                break;
            case 'CONTENTTYPE':
                if ($this->lstContentType->SelectedValue)
                    return $this->lstContentType->SelectedValue;
                break;
            case 'POSITION':
                if ($this->txtPosition->Text)
                    return $this->txtPosition->Text;
                break;
            case 'EMAILTEMPLATECONTENTROW':
                if ($this->lstEmailTemplateContentRow->SelectedValue)
                    return $this->lstEmailTemplateContentRow->SelectedValue;
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
            case 'CONTENTBLOCK':
                if ($this->txtContentBlock)
                    return $this->txtContentBlock->ControlId;
                break;
            case 'CONTENTTYPE':
                if ($this->lstContentType)
                    return $this->lstContentType->ControlId;
                break;
            case 'POSITION':
                if ($this->txtPosition)
                    return $this->txtPosition->ControlId;
                break;
            case 'EMAILTEMPLATECONTENTROW':
                if ($this->lstEmailTemplateContentRow)
                    return $this->lstEmailTemplateContentRow->ControlId;
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
            case 'CONTENTBLOCK':
                $this->txtContentBlock->Visible = false;
                $this->txtContentBlock->Refresh();
                break;
            case 'CONTENTTYPE':
                $this->lstContentType->Visible = false;
                $this->lstContentType->Refresh();
                break;
            case 'POSITION':
                $this->txtPosition->Visible = false;
                $this->txtPosition->Refresh();
                break;
            case 'EMAILTEMPLATECONTENTROW':
                $this->lstEmailTemplateContentRow->Visible = false;
                $this->lstEmailTemplateContentRow->Refresh();
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
            case 'CONTENTBLOCK':
                $this->txtContentBlock->Visible = true;
                $this->txtContentBlock->Refresh();
                break;
            case 'CONTENTTYPE':
                $this->lstContentType->Visible = true;
                $this->lstContentType->Refresh();
                break;
            case 'POSITION':
                $this->txtPosition->Visible = true;
                $this->txtPosition->Refresh();
                break;
            case 'EMAILTEMPLATECONTENTROW':
                $this->lstEmailTemplateContentRow->Visible = true;
                $this->lstEmailTemplateContentRow->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtContentBlock->getJqControlId();
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

    public function applyValuesBeforeSaveObject($EmailTemplateContentRow = null)  {
        if (!$this->Object)
            $this->Object = new EmailTemplateContentBlock();
        
        $this->Object->ContentBlock = $this->txtContentBlock->Text;
        $this->Object->ContentType = $this->lstContentType->SelectedValue;
        $this->Object->Position = $this->txtPosition->Text;
        if ($EmailTemplateContentRow) {
            $this->Object->EmailTemplateContentRowObject = $EmailTemplateContentRow;
        }
        if ($this->saveUsingLstEmailTemplateContentRow) {
            $linkedEmailTemplateContentRow = EmailTemplateContentRow::Load($this->lstEmailTemplateContentRow->SelectedValue);
            $this->Object->EmailTemplateContentRowObject = $linkedEmailTemplateContentRow;
        }
    }

    public function saveObject($validate = true,$EmailTemplateContentRow = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($EmailTemplateContentRow);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtContentBlock);
        // Example of validating a field as required
        //AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(''.$this->txtUsername->getJqControlId().'')');
        /*if (!$this->lstContentType->SelectedValue){
            AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(''.$this->txtUsername->getJqControlId().'','Required')');
            $hasNoErrors = false;
        }*/
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPosition);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtContentBlock->WrapperCssClass = 'form-group';
            $this->txtContentBlock->Placeholder = '';
            $this->lstContentType->WrapperCssClass = 'form-group';
            $this->txtPosition->WrapperCssClass = 'form-group';
            $this->txtPosition->Placeholder = '';
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
            $previousValues = EmailTemplateContentBlock::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'ContentBlock-> Value before: '.$previousValues->ContentBlock.', Value after: '.$this->Object->ContentBlock.'<br>
        ContentType-> Value before: '.$previousValues->ContentType.', Value after: '.$this->Object->ContentType.'<br>
        Position-> Value before: '.$previousValues->Position.', Value after: '.$this->Object->Position.'<br>
        ';
        } else {
        $changeText = 'ContentBlock-> Value: '.$this->Object->ContentBlock.'<br>
        ContentType-> Value: '.$this->Object->ContentType.'<br>
        Position-> Value: '.$this->Object->Position.'<br>
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
            $AuditLogEntry->ObjectName = 'EmailTemplateContentBlock';
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
                $AuditLogEntry->ObjectName = 'EmailTemplateContentBlock';
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