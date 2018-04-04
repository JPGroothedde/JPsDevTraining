<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
require('sCSVImportExample.php');
//AppSpecificFunctions::CheckRemoteAdmin();

class CSVImportUploadForm extends QForm {
    protected $CSVImporter;

    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->CSVImporter = new sCSVImporter($this,null,'CSVImport_UploadCompleted',',',5,'PlaceHolder');

    }
    protected function CSVImport_UploadCompleted($strFormId, $strControlId, $strParameter) {
        $this->CSVImporter->CSVImport_UploadCompleted($strFormId, $strControlId, $strParameter);
        $this->CSVImporter->showImportMapping();
    }
    protected function DoCSVImport($strFormId, $strControlId, $strParameter) {
        $result = $this->CSVImporter->DoCSVImport($strFormId, $strControlId, $strParameter);
        AppSpecificFunctions::ShowNotedFeedback($result.' Rows successfully imported!');
    }

}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
CSVImportUploadForm::Run('CSVImportUploadForm');
?>