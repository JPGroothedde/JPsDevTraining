<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PostComment/PostCommentController.php');
require(__SDEV_CONTROLS__.'/Implementations/PostComment/PostCommentDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PostComment_OverviewForm extends QForm {
    // Data grid variables
    protected $PostCommentGrid;
    protected $PostCommentWaitControlIcon;
    protected $btnNewPostComment;
    protected $selectedPostCommentId = -1;

    // PostComment Object variables
    protected $PostCommentInstance;
    protected $btnSavePostComment,$btnDeletePostComment;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPostCommentDataGrid();
        $this->InitPostCommentModal();
    }
    protected function InitPostCommentModal() {
        $this->PostCommentInstance = new PostCommentController($this);

        $this->btnSavePostComment = new QButton($this);
        $this->btnSavePostComment->Text = 'Save';
        $this->btnSavePostComment->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePostComment->AddAction(new QClickEvent(), new QAjaxAction('btnSavePostComment_Clicked'));

        $this->btnDeletePostComment = new QButton($this);
        $this->btnDeletePostComment->Text = 'Delete';
        $this->btnDeletePostComment->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePostComment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePostComment->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePostComment_Clicked'));
    }
    protected function btnSavePostComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostCommentInstance->saveObject()) {
            $this->PostCommentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PostCommentModal');
        }
    }
    protected function btnDeletePostComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostCommentInstance->deleteObject()) {
            $this->PostCommentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PostCommentModal');
        }
    }
    protected function InitPostCommentDataGrid() {
        $searchableAttributes = array(QQN::PostComment()->PostCommentText,QQN::PostComment()->AccountObject->Id,QQN::PostComment()->PostObject->Id);
        $headerItems = array('Post Comment Text','Account Object','Post Object');
        $headerSortNodes = array(QQN::PostComment()->PostCommentText,QQN::PostComment()->AccountObject->Id,QQN::PostComment()->PostObject->Id);
        $columnItems = array('PostCommentText','Account','Post');
        $this->PostCommentWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPostComment = new QButton($this);
        $this->btnNewPostComment->Text = 'Add PostComment';
        $this->btnNewPostComment->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPostComment->AddAction(new QClickEvent(), new QAjaxAction('btnNewPostComment_Clicked'));
        $this->PostCommentGrid = new PostCommentDataGrid($this, QQN::PostComment(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PostCommentWaitControlIcon, 'PostCommentGrid');
    }
    protected function PostCommentGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostCommentGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostCommentGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostCommentGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostCommentGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostCommentGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostCommentGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostCommentGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostCommentGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PostCommentGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PostCommentGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPostCommentId = $strParameter;
        $theObject = PostComment::Load($this->selectedPostCommentId);
        if ($theObject) {
            $this->PostCommentInstance->setObject($theObject);
            $this->PostCommentInstance->setValues($theObject);
            $this->PostCommentInstance->refreshAll();
            $this->btnDeletePostComment->Visible = true;
            AppSpecificFunctions::ToggleModal('PostCommentModal');
        }
    }
    protected function btnNewPostComment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPostCommentId = -1;
        $this->PostCommentInstance->setObject(null);
        $this->PostCommentInstance->setValues(null);
        $this->btnDeletePostComment->Visible = false;
        AppSpecificFunctions::ToggleModal('PostCommentModal');
    }
}
PostComment_OverviewForm::Run('PostComment_OverviewForm');
?>