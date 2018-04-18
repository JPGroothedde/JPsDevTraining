<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class FileUploadForm extends QForm {
    protected $btnSelect,$EntitySelectModal;
    public function Form_Create() {
        parent::Form_Create();
        $this->EntitySelectModal = new sEntitySelectModal($this,'Account',array('FullName','EmailAddress'),array('FullName','EmailAddress','Username'),'doAccountSearch','doAccountSelect','modal-lg');
        $this->btnSelect = AppSpecificFunctions::getNewActionButton($this,'Select Account','btn btn-default','SelectAccount');
    }
    protected function SelectAccount() {
        $this->EntitySelectModal->ToggleModal();
    }
    protected function doAccountSearch($strFormId, $strControlId, $strParameter) {
        $this->EntitySelectModal->updateSearchResults();
    }
    protected function doAccountSelect($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::ShowNotedFeedback('ID: '.$this->EntitySelectModal->getSelectedId($strParameter).' Selected!');
        $this->EntitySelectModal->ToggleModal();
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
FileUploadForm::Run('FileUploadForm');
?>