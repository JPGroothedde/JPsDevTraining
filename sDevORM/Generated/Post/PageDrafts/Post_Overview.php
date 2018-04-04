<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Post/PostController.php');
require(__SDEV_CONTROLS__.'/Implementations/Post/PostDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Post_OverviewForm extends QForm {
    // Data grid variables
    protected $PostGrid;
    protected $PostWaitControlIcon;
    protected $btnNewPost;
    protected $selectedPostId = -1;

    // Post Object variables
    protected $PostInstance;
    protected $btnSavePost,$btnDeletePost;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPostDataGrid();
        $this->InitPostModal();
    }
    protected function InitPostModal() {
        $this->PostInstance = new PostController($this);

        $this->btnSavePost = new QButton($this);
        $this->btnSavePost->Text = 'Save';
        $this->btnSavePost->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePost->AddAction(new QClickEvent(), new QAjaxAction('btnSavePost_Clicked'));

        $this->btnDeletePost = new QButton($this);
        $this->btnDeletePost->Text = 'Delete';
        $this->btnDeletePost->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePost->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePost->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePost_Clicked'));
    }
    protected function btnSavePost_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostInstance->saveObject()) {
            $this->PostGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PostModal');
        }
    }
    protected function btnDeletePost_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostInstance->deleteObject()) {
            $this->PostGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PostModal');
        }
    }
    protected function InitPostDataGrid() {
        $searchableAttributes = array(QQN::Post()->PostText,QQN::Post()->DateCreated,QQN::Post()->AccountObject->Id);
        $headerItems = array('Post Text','Date Created','Account Object');
        $headerSortNodes = array(QQN::Post()->PostText,QQN::Post()->DateCreated,QQN::Post()->AccountObject->Id);
        $columnItems = array('PostText','DateCreated','Account');
        $this->PostWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPost = new QButton($this);
        $this->btnNewPost->Text = 'Add Post';
        $this->btnNewPost->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPost->AddAction(new QClickEvent(), new QAjaxAction('btnNewPost_Clicked'));
        $this->PostGrid = new PostDataGrid($this, QQN::Post(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PostWaitControlIcon, 'PostGrid');
    }
    protected function PostGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PostGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PostGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPostId = $strParameter;
        $theObject = Post::Load($this->selectedPostId);
        if ($theObject) {
            $this->PostInstance->setObject($theObject);
            $this->PostInstance->setValues($theObject);
            $this->PostInstance->refreshAll();
            $this->btnDeletePost->Visible = true;
            AppSpecificFunctions::ToggleModal('PostModal');
        }
    }
    protected function btnNewPost_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPostId = -1;
        $this->PostInstance->setObject(null);
        $this->PostInstance->setValues(null);
        $this->btnDeletePost->Visible = false;
        AppSpecificFunctions::ToggleModal('PostModal');
    }
}
Post_OverviewForm::Run('Post_OverviewForm');
?>