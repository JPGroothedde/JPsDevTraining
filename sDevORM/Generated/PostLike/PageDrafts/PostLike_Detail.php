<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PostLike/PostLikeController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PostLike_DetailForm extends QForm {
    // PostLike Object variables
    protected $PostLikeInstance;
    protected $btnSavePostLike,$btnDeletePostLike,$btnCancelPostLike;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPostLikeInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PostLike::Load($objId);
            if ($theObject) {
                $this->PostLikeInstance->setObject($theObject);
                $this->PostLikeInstance->setValues($theObject);
                $this->PostLikeInstance->refreshAll();
                $this->btnDeletePostLike->Visible = true;
            } else {
                $this->PostLikeInstance->setObject(null);
                $this->PostLikeInstance->setValues(null);
                $this->btnDeletePostLike->Visible = false;
            }
        } else {
            $this->PostLikeInstance->setObject(null);
            $this->PostLikeInstance->setValues(null);
            $this->btnDeletePostLike->Visible = false;
        }
    }
    protected function InitPostLikeInstance() {
        $this->PostLikeInstance = new PostLikeController($this);

        $this->btnSavePostLike = new QButton($this);
        $this->btnSavePostLike->Text = 'Save';
        $this->btnSavePostLike->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePostLike->AddAction(new QClickEvent(), new QAjaxAction('btnSavePostLike_Clicked'));

        $this->btnDeletePostLike = new QButton($this);
        $this->btnDeletePostLike->Text = 'Delete';
        $this->btnDeletePostLike->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePostLike->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePostLike->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePostLike_Clicked'));

        $this->btnCancelPostLike = new QButton($this);
        $this->btnCancelPostLike->Text = 'Cancel';
        $this->btnCancelPostLike->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPostLike->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPostLike_Clicked'));
    }
    protected function btnSavePostLike_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostLikeInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeletePostLike_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostLikeInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelPostLike_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
PostLike_DetailForm::Run('PostLike_DetailForm');
?>