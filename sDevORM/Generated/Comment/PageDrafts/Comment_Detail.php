<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Comment/CommentController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Comment_DetailForm extends QForm {
    // Comment Object variables
    protected $CommentInstance;
    protected $btnSaveComment,$btnDeleteComment,$btnCancelComment;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitCommentInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Comment::Load($objId);
            if ($theObject) {
                $this->CommentInstance->setObject($theObject);
                $this->CommentInstance->setValues($theObject);
                $this->CommentInstance->refreshAll();
                $this->btnDeleteComment->Visible = true;
            } else {
                $this->CommentInstance->setObject(null);
                $this->CommentInstance->setValues(null);
                $this->btnDeleteComment->Visible = false;
            }
        } else {
            $this->CommentInstance->setObject(null);
            $this->CommentInstance->setValues(null);
            $this->btnDeleteComment->Visible = false;
        }
    }
    protected function InitCommentInstance() {
        $this->CommentInstance = new CommentController($this);

        $this->btnSaveComment = new QButton($this);
        $this->btnSaveComment->Text = 'Save';
        $this->btnSaveComment->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveComment->AddAction(new QClickEvent(), new QAjaxAction('btnSaveComment_Clicked'));

        $this->btnDeleteComment = new QButton($this);
        $this->btnDeleteComment->Text = 'Delete';
        $this->btnDeleteComment->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteComment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteComment->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteComment_Clicked'));

        $this->btnCancelComment = new QButton($this);
        $this->btnCancelComment->Text = 'Cancel';
        $this->btnCancelComment->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelComment->AddAction(new QClickEvent(), new QAjaxAction('btnCancelComment_Clicked'));
    }
    protected function btnSaveComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CommentInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CommentInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelComment_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Comment_DetailForm::Run('Comment_DetailForm');
?>