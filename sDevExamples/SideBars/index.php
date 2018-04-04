<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class SideBarsForm extends QForm {
    public function Form_Create() {
        parent::Form_Create();
    }

}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
SideBarsForm::Run('SideBarsForm');
?>