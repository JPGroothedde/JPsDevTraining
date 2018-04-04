<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PageView/PageViewController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PageView_DetailForm extends QForm {
    // PageView Object variables
    protected $PageViewInstance;
    protected $btnSavePageView,$btnDeletePageView,$btnCancelPageView;

    //Mobile detection
    protected $deviceType;
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        $detect = new Mobile_Detect;
        $this->deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        if ($this->deviceType == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPageViewInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PageView::Load($objId);
            if ($theObject) {
                $this->PageViewInstance->setObject($theObject);
                $this->PageViewInstance->setValues($theObject);
                $this->PageViewInstance->refreshAll();
                $this->btnDeletePageView->Visible = true;
            } else {
                $this->PageViewInstance->setObject(null);
                $this->PageViewInstance->setValues(null);
                $this->btnDeletePageView->Visible = false;
            }
        } else {
            $this->PageViewInstance->setObject(null);
            $this->PageViewInstance->setValues(null);
            $this->btnDeletePageView->Visible = false;
        }
    }
    protected function InitPageViewInstance() {
        $this->PageViewInstance = new PageViewController($this);

        $this->btnSavePageView = new QButton($this);
        $this->btnSavePageView->Text = 'Save PageView';
        $this->btnSavePageView->AddAction(new QClickEvent(), new QAjaxAction('btnSavePageView_Clicked'));

        $this->btnDeletePageView = new QButton($this);
        $this->btnDeletePageView->Text = 'Delete PageView';
        $this->btnDeletePageView->CssClass = 'btn btn-danger';
        $this->btnDeletePageView->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePageView->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePageView_Clicked'));

        $this->btnCancelPageView = new QButton($this);
        $this->btnCancelPageView->Text = 'Cancel';
        $this->btnCancelPageView->CssClass = 'btn btn-default';
        $this->btnCancelPageView->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPageView_Clicked'));
    }
    protected function btnSavePageView_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PageViewInstance->saveObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeletePageView_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PageViewInstance->deleteObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelPageView_Clicked($strFormId, $strControlId, $strParameter) {
        QApplication::Redirect(loadPreviousPage());
    }
}
PageView_DetailForm::Run('PageView_DetailForm');
?>