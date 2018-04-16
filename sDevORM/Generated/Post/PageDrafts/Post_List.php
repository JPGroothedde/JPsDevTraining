<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Post/PostController.php');
require(__SDEV_CONTROLS__.'/Implementations/Post/PostDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Post_ListForm extends QForm {
    // Data list variables
    protected $PostList;
    protected $btnNewPost;

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

        $this->InitPostDataList();
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
            $this->PostList->refreshList();
            AppSpecificFunctions::ToggleModal('PostModal');
        }
    }
    protected function btnDeletePost_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostInstance->deleteObject()) {
            $this->PostList->refreshList();
            AppSpecificFunctions::ToggleModal('PostModal');
        }
    }
    protected function InitPostDataList() {
        $searchableAttributes = array(QQN::Post()->PostText,QQN::Post()->PostTimeStamp,QQN::Post()->AccountObject->Id);
        $SortAttributesShown = array('Post Text','Post Time Stamp','Account Object');
        $SortAttributes = array(QQN::Post()->PostText,QQN::Post()->PostTimeStamp,QQN::Post()->AccountObject->Id);
        $columnItems = array('PostText','PostTimeStamp','Account');
        $this->btnNewPost = AppSpecificFunctions::getNewActionButton($this,'Add Post','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPost_Clicked');
        $this->PostList = new PostDataList($this, QQN::Post(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Post_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostList->getActiveId() != $strParameter)
                $this->PostList->setActiveId($strParameter);
            else
                $this->PostList->setActiveId(null);
        $theObject = Post::Load($strParameter);
        if ($theObject) {
            $this->PostInstance->setObject($theObject);
            $this->PostInstance->setValues($theObject);
            $this->PostInstance->refreshAll();
            $this->btnDeletePost->Visible = true;
            AppSpecificFunctions::ToggleModal('PostModal');
        }
    }
    protected function Post_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PostList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Post_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PostList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Post_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PostList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Post_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PostList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Post_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PostList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPost_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostList->setActiveId(null);
        $this->PostInstance->setObject(null);
        $this->PostInstance->setValues(null);
        $this->btnDeletePost->Visible = false;
        AppSpecificFunctions::ToggleModal('PostModal');
    }
}
Post_ListForm::Run('Post_ListForm');
?>