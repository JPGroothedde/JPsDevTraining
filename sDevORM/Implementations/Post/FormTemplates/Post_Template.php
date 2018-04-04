<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/Post/PostController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Post_DetailForm extends QForm {
    // Post Object variables
    protected $PostInstance;
    protected $btnSavePost,$btnDeletePost,$btnCancelPost;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPostInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Post::Load($objId);
            if ($theObject) {
                $this->PostInstance->setObject($theObject);
                $this->PostInstance->setValues($theObject);
                $this->PostInstance->refreshAll();
                $this->btnDeletePost->Visible = true;
            } else {
                $this->PostInstance->setObject(null);
                $this->PostInstance->setValues(null);
                $this->btnDeletePost->Visible = false;
            }
        } else {
            $this->PostInstance->setObject(null);
            $this->PostInstance->setValues(null);
            $this->btnDeletePost->Visible = false;
        }
    }
    protected function InitPostInstance() {
        $this->PostInstance = new PostController($this);

        $this->btnSavePost = new QButton($this);
        $this->btnSavePost->Text = 'Save';
        $this->btnSavePost->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePost->AddAction(new QClickEvent(), new QAjaxAction('btnSavePost_Clicked'));

        $this->btnDeletePost = new QButton($this);
        $this->btnDeletePost->Text = 'Delete';
        $this->btnDeletePost->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePost->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePost->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePost_Clicked'));

        $this->btnCancelPost = new QButton($this);
        $this->btnCancelPost->Text = 'Cancel';
        $this->btnCancelPost->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPost->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPost_Clicked'));
    }
    protected function btnSavePost_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeletePost_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
Post_DetailForm::Run('Post_DetailForm');
?>