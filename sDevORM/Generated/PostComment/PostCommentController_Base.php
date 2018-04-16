<?php
class PostCommentController_Base {
    protected $Object;
    public $txtPostCommentText;
    public $lstAccount,$saveUsingLstAccount = false;
    public $lstPost,$saveUsingLstPost = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtPostCommentText = new QTextBox($objParentObject);
        $this->txtPostCommentText->Name = 'Post Comment Text';

        $this->lstAccount = new QListBox($objParentObject);
        $this->lstAccount->Name = 'Account';
        $this->lstAccount->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allAccount = Account::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allAccount as $Account) {
            $this->lstAccount->AddItem(new QListItem($Account->Id,$Account->Id));
        }

        $this->lstPost = new QListBox($objParentObject);
        $this->lstPost->Name = 'Post';
        $this->lstPost->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allPost = Post::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allPost as $Post) {
            $this->lstPost->AddItem(new QListItem($Post->Id,$Post->Id));
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
            if ($ReferenceObject == 'Post') {
                $this->lstPost->RemoveAllItems();
                $allPost_list = Post::LoadAll();
                foreach ($allPost_list as $Post) {
                    $this->lstPost->AddItem(new QListItem($Post->__get($ReferenceAttribute),$Post->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Account') {
                $this->saveUsingLstAccount = $useListValue;
            }
            if ($ReferenceObject == 'Post') {
                $this->saveUsingLstPost = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtPostCommentText->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->PostCommentText)) {
            $this->txtPostCommentText->Text = $Object->PostCommentText;
        }
        
        if (!is_null($Object->AccountObject)) {
            $this->lstAccount->SelectedValue = $Object->AccountObject->Id;
        }
        if (!is_null($Object->PostObject)) {
            $this->lstPost->SelectedValue = $Object->PostObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'POSTCOMMENTTEXT') {
            if (strlen($nameValue) > 0)
                $this->txtPostCommentText->Name = $nameValue;
            $output = $withName ? $this->txtPostCommentText->RenderWithName($blnPrintOutput):$this->txtPostCommentText->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ACCOUNT') {
            if (strlen($nameValue) > 0)
                $this->lstAccount->Name = $nameValue;
            $output = $withName ? $this->lstAccount->RenderWithName($blnPrintOutput):$this->lstAccount->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'POST') {
            if (strlen($nameValue) > 0)
                $this->lstPost->Name = $nameValue;
            $output = $withName ? $this->lstPost->RenderWithName($blnPrintOutput):$this->lstPost->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('POSTCOMMENTTEXT',$withName);
        $this->renderControl('ACCOUNT',$withName);
        $this->renderControl('POST',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('PostCommentText',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtPostCommentText->Visible = false;
        $this->lstAccount->Visible = false;
        $this->lstPost->Visible = false;
    }

    public function showAll() {
        $this->txtPostCommentText->Visible = true;
        $this->lstAccount->Visible = true;
        $this->lstPost->Visible = true;
    }

    public function refreshAll() {
        $this->txtPostCommentText->Refresh();
        $this->lstAccount->Refresh();
        $this->lstPost->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'POSTCOMMENTTEXT':
                $this->txtPostCommentText->Text = $value;
                break;
            case 'ACCOUNT':
                $this->lstAccount->SelectedValue = $value;
                break;
            case 'POST':
                $this->lstPost->SelectedValue = $value;
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
            case 'POSTCOMMENTTEXT':
                if ($this->txtPostCommentText->Text)
                    return $this->txtPostCommentText->Text;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount->SelectedValue)
                    return $this->lstAccount->SelectedValue;
                break;
            case 'POST':
                if ($this->lstPost->SelectedValue)
                    return $this->lstPost->SelectedValue;
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
            case 'POSTCOMMENTTEXT':
                if ($this->txtPostCommentText)
                    return $this->txtPostCommentText->ControlId;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount)
                    return $this->lstAccount->ControlId;
                break;
            case 'POST':
                if ($this->lstPost)
                    return $this->lstPost->ControlId;
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
            case 'POSTCOMMENTTEXT':
                $this->txtPostCommentText->Visible = false;
                $this->txtPostCommentText->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = false;
                $this->lstAccount->Refresh();
                break;
            case 'POST':
                $this->lstPost->Visible = false;
                $this->lstPost->Refresh();
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
            case 'POSTCOMMENTTEXT':
                $this->txtPostCommentText->Visible = true;
                $this->txtPostCommentText->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = true;
                $this->lstAccount->Refresh();
                break;
            case 'POST':
                $this->lstPost->Visible = true;
                $this->lstPost->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtPostCommentText->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Account = null,$Post = null)  {
        if (!$this->Object)
            $this->Object = new PostComment();
        
        $this->Object->PostCommentText = $this->txtPostCommentText->Text;
        if ($Account) {
            $this->Object->AccountObject = $Account;
        }
        if ($this->saveUsingLstAccount) {
            $linkedAccount = Account::Load($this->lstAccount->SelectedValue);
            $this->Object->AccountObject = $linkedAccount;
        }
        if ($Post) {
            $this->Object->PostObject = $Post;
        }
        if ($this->saveUsingLstPost) {
            $linkedPost = Post::Load($this->lstPost->SelectedValue);
            $this->Object->PostObject = $linkedPost;
        }
    }

    public function saveObject($validate = true,$Account = null,$Post = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Account,$Post);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPostCommentText);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtPostCommentText->WrapperCssClass = 'form-group';
            $this->txtPostCommentText->Placeholder = '';
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
            $previousValues = PostComment::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'PostCommentText-> Value before: '.$previousValues->PostCommentText.', Value after: '.$this->Object->PostCommentText.'<br>
        ';
        } else {
        $changeText = 'PostCommentText-> Value: '.$this->Object->PostCommentText.'<br>
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
            $AuditLogEntry->ObjectName = 'PostComment';
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
                $AuditLogEntry->ObjectName = 'PostComment';
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