<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/PlaceHolder/PlaceHolderController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PlaceHolder_DetailForm extends QForm {
    // PlaceHolder Object variables
    protected $PlaceHolderInstance;
    protected $btnSavePlaceHolder,$btnDeletePlaceHolder,$btnCancelPlaceHolder;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (QApplication::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPlaceHolderInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PlaceHolder::Load($objId);
            if ($theObject) {
                $this->PlaceHolderInstance->setObject($theObject);
                $this->PlaceHolderInstance->setValues($theObject);
                $this->PlaceHolderInstance->refreshAll();
                $this->btnDeletePlaceHolder->Visible = true;
            } else {
                $this->PlaceHolderInstance->setObject(null);
                $this->PlaceHolderInstance->setValues(null);
                $this->btnDeletePlaceHolder->Visible = false;
            }
        } else {
            $this->PlaceHolderInstance->setObject(null);
            $this->PlaceHolderInstance->setValues(null);
            $this->btnDeletePlaceHolder->Visible = false;
        }
    }
    protected function InitPlaceHolderInstance() {
        $this->PlaceHolderInstance = new PlaceHolderController($this);

        $this->btnSavePlaceHolder = new QButton($this);
        $this->btnSavePlaceHolder->Text = 'Save PlaceHolder';
        $this->btnSavePlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnSavePlaceHolder_Clicked'));

        $this->btnDeletePlaceHolder = new QButton($this);
        $this->btnDeletePlaceHolder->Text = 'Delete PlaceHolder';
        $this->btnDeletePlaceHolder->CssClass = 'btn btn-danger';
        $this->btnDeletePlaceHolder->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePlaceHolder_Clicked'));

        $this->btnCancelPlaceHolder = new QButton($this);
        $this->btnCancelPlaceHolder->Text = 'Cancel';
        $this->btnCancelPlaceHolder->CssClass = 'btn btn-default';
        $this->btnCancelPlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPlaceHolder_Clicked'));
    }
    protected function btnSavePlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderInstance->saveObject()) {
            QApplication::ShowNotedFeedback('Saved!');
        } else
            QApplication::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeletePlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderInstance->deleteObject()) {
            QApplication::ShowNotedFeedback('Deleted!');
        } else
            QApplication::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        QApplication::ExecuteJavaScript($js);
    }
    protected function btnDummyFour_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->Toggle(!$this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->IsToggled);
    }

    
}
PlaceHolder_DetailForm::Run('PlaceHolder_DetailForm');
?>