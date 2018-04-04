<?php
class EmailTemplateController_Base {
    protected $Object;
    public $txtTemplateName;
    public $txtCcAddresses;
    public $txtBccAddresses;
    public $btnPublished;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtTemplateName = new QTextBox($objParentObject);
        $this->txtTemplateName->Name = 'Template Name';

        $this->txtCcAddresses = new QTextBox($objParentObject);
        $this->txtCcAddresses->Name = 'Cc Addresses';

        $this->txtBccAddresses = new QTextBox($objParentObject);
        $this->txtBccAddresses->Name = 'Bcc Addresses';

        $this->btnPublished = new QButton($objParentObject);
        $this->btnPublished->Name = 'Published';
        $this->btnPublished->HtmlEntities = false;
        $trueLabel = 'Published';
        $falseLabel = 'Published';
        if (strlen($trueLabel) < 1)
            $trueLabel = null;
        if (strlen($falseLabel) < 1)
            $falseLabel = null;
        $this->btnPublished->setAsToggle(true,$trueLabel,$falseLabel);
        $this->btnPublished->DisplayStyle = QDisplayStyle::Block;
        $this->btnPublished->AddAction(new QClickEvent(), new QAjaxAction('btnPublished_Clicked'));//btnPublished_Clicked must be implemented in Page Controller class (QForm class)

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
        $this->txtTemplateName->Text = '';
        $this->txtCcAddresses->Text = '';
        $this->txtBccAddresses->Text = '';
        
        $this->btnPublished->IsToggled = false;

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->TemplateName)) {
            $this->txtTemplateName->Text = $Object->TemplateName;
        }
        if (!is_null($Object->CcAddresses)) {
            $this->txtCcAddresses->Text = $Object->CcAddresses;
        }
        if (!is_null($Object->BccAddresses)) {
            $this->txtBccAddresses->Text = $Object->BccAddresses;
        }
        if ($Object->Published == 1) {
            $this->btnPublished->Toggle();
        } else {
            $this->btnPublished->Toggle(false);
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'TEMPLATENAME') {
            if (strlen($nameValue) > 0)
                $this->txtTemplateName->Name = $nameValue;
            $output = $withName ? $this->txtTemplateName->RenderWithName($blnPrintOutput):$this->txtTemplateName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CCADDRESSES') {
            if (strlen($nameValue) > 0)
                $this->txtCcAddresses->Name = $nameValue;
            $output = $withName ? $this->txtCcAddresses->RenderWithName($blnPrintOutput):$this->txtCcAddresses->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'BCCADDRESSES') {
            if (strlen($nameValue) > 0)
                $this->txtBccAddresses->Name = $nameValue;
            $output = $withName ? $this->txtBccAddresses->RenderWithName($blnPrintOutput):$this->txtBccAddresses->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PUBLISHED') {
            if (strlen($nameValue) > 0)
                $this->btnPublished->Name = $nameValue;
            $output = $withName ? $this->btnPublished->RenderWithName($blnPrintOutput):$this->btnPublished->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('TEMPLATENAME',$withName);
        $this->renderControl('CCADDRESSES',$withName);
        $this->renderControl('BCCADDRESSES',$withName);
        $this->renderControl('PUBLISHED',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('TemplateName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('CcAddresses',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('BccAddresses',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Published',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtTemplateName->Visible = false;
        $this->txtCcAddresses->Visible = false;
        $this->txtBccAddresses->Visible = false;
        $this->btnPublished->Visible = false;
    }

    public function showAll() {
        $this->txtTemplateName->Visible = true;
        $this->txtCcAddresses->Visible = true;
        $this->txtBccAddresses->Visible = true;
        $this->btnPublished->Visible = true;
    }

    public function refreshAll() {
        $this->txtTemplateName->Refresh();
        $this->txtCcAddresses->Refresh();
        $this->txtBccAddresses->Refresh();
        $this->btnPublished->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'TEMPLATENAME':
                $this->txtTemplateName->Text = $value;
                break;
            case 'CCADDRESSES':
                $this->txtCcAddresses->Text = $value;
                break;
            case 'BCCADDRESSES':
                $this->txtBccAddresses->Text = $value;
                break;
            case 'PUBLISHED':
                $this->btnPublished->IsToggled = $value;
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
            case 'TEMPLATENAME':
                if ($this->txtTemplateName->Text)
                    return $this->txtTemplateName->Text;
                break;
            case 'CCADDRESSES':
                if ($this->txtCcAddresses->Text)
                    return $this->txtCcAddresses->Text;
                break;
            case 'BCCADDRESSES':
                if ($this->txtBccAddresses->Text)
                    return $this->txtBccAddresses->Text;
                break;
            case 'PUBLISHED':
                if ($this->btnPublished->IsToggled)
                    return $this->btnPublished->IsToggled;
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
            case 'TEMPLATENAME':
                if ($this->txtTemplateName)
                    return $this->txtTemplateName->ControlId;
                break;
            case 'CCADDRESSES':
                if ($this->txtCcAddresses)
                    return $this->txtCcAddresses->ControlId;
                break;
            case 'BCCADDRESSES':
                if ($this->txtBccAddresses)
                    return $this->txtBccAddresses->ControlId;
                break;
            case 'PUBLISHED':
                if ($this->btnPublished)
                    return $this->btnPublished->ControlId;
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
            case 'TEMPLATENAME':
                $this->txtTemplateName->Visible = false;
                $this->txtTemplateName->Refresh();
                break;
            case 'CCADDRESSES':
                $this->txtCcAddresses->Visible = false;
                $this->txtCcAddresses->Refresh();
                break;
            case 'BCCADDRESSES':
                $this->txtBccAddresses->Visible = false;
                $this->txtBccAddresses->Refresh();
                break;
            case 'PUBLISHED':
                $this->btnPublished->Visible = false;
                $this->btnPublished->Refresh();
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
            case 'TEMPLATENAME':
                $this->txtTemplateName->Visible = true;
                $this->txtTemplateName->Refresh();
                break;
            case 'CCADDRESSES':
                $this->txtCcAddresses->Visible = true;
                $this->txtCcAddresses->Refresh();
                break;
            case 'BCCADDRESSES':
                $this->txtBccAddresses->Visible = true;
                $this->txtBccAddresses->Refresh();
                break;
            case 'PUBLISHED':
                $this->btnPublished->Visible = true;
                $this->btnPublished->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtTemplateName->getJqControlId();
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
            $this->Object = new EmailTemplate();
        
        $this->Object->TemplateName = $this->txtTemplateName->Text;
        $this->Object->CcAddresses = $this->txtCcAddresses->Text;
        $this->Object->BccAddresses = $this->txtBccAddresses->Text;
        $this->Object->Published = $this->btnPublished->IsToggled?1:0;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtTemplateName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtCcAddresses);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtBccAddresses);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtTemplateName->WrapperCssClass = 'form-group';
            $this->txtTemplateName->Placeholder = '';
            $this->txtCcAddresses->WrapperCssClass = 'form-group';
            $this->txtCcAddresses->Placeholder = '';
            $this->txtBccAddresses->WrapperCssClass = 'form-group';
            $this->txtBccAddresses->Placeholder = '';
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
            $previousValues = EmailTemplate::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'TemplateName-> Value before: '.$previousValues->TemplateName.', Value after: '.$this->Object->TemplateName.'<br>
        CcAddresses-> Value before: '.$previousValues->CcAddresses.', Value after: '.$this->Object->CcAddresses.'<br>
        BccAddresses-> Value before: '.$previousValues->BccAddresses.', Value after: '.$this->Object->BccAddresses.'<br>
        Published-> Value before: '.$previousValues->Published.', Value after: '.$this->Object->Published.'<br>
        ';
        } else {
        $changeText = 'TemplateName-> Value: '.$this->Object->TemplateName.'<br>
        CcAddresses-> Value: '.$this->Object->CcAddresses.'<br>
        BccAddresses-> Value: '.$this->Object->BccAddresses.'<br>
        Published-> Value: '.$this->Object->Published.'<br>
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
            $AuditLogEntry->ObjectName = 'EmailTemplate';
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
                $AuditLogEntry->ObjectName = 'EmailTemplate';
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