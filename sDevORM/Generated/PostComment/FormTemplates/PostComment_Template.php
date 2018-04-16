<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/PostComment/PostCommentController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PostComment_DetailForm extends QForm {
    // PostComment Object variables
    protected $PostCommentInstance;
    protected $btnSavePostComment,$btnDeletePostComment,$btnCancelPostComment;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPostCommentInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PostComment::Load($objId);
            if ($theObject) {
                $this->PostCommentInstance->setObject($theObject);
                $this->PostCommentInstance->setValues($theObject);
                $this->PostCommentInstance->refreshAll();
                $this->btnDeletePostComment->Visible = true;
            } else {
                $this->PostCommentInstance->setObject(null);
                $this->PostCommentInstance->setValues(null);
                $this->btnDeletePostComment->Visible = false;
            }
        } else {
            $this->PostCommentInstance->setObject(null);
            $this->PostCommentInstance->setValues(null);
            $this->btnDeletePostComment->Visible = false;
        }
    }
    protected function InitPostCommentInstance() {
        $this->PostCommentInstance = new PostCommentController($this);

        $this->btnSavePostComment = new QButton($this);
        $this->btnSavePostComment->Text = 'Save';
        $this->btnSavePostComment->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePostComment->AddAction(new QClickEvent(), new QAjaxAction('btnSavePostComment_Clicked'));

        $this->btnDeletePostComment = new QButton($this);
        $this->btnDeletePostComment->Text = 'Delete';
        $this->btnDeletePostComment->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePostComment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePostComment->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePostComment_Clicked'));

        $this->btnCancelPostComment = new QButton($this);
        $this->btnCancelPostComment->Text = 'Cancel';
        $this->btnCancelPostComment->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPostComment->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPostComment_Clicked'));
    }
    protected function btnSavePostComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostCommentInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeletePostComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostCommentInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
PostComment_DetailForm::Run('PostComment_DetailForm');
?>