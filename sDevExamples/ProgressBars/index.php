<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class ProgressBarsForm extends QForm {
    protected $ProgressBar,$btnUpdateValue,$txtValueToUpdate;
    protected $height;
    public function Form_Create() {
        parent::Form_Create();
        $this->ProgressBar = new sUIElementsProgressBar($this);
        $this->height = 600;
        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->height = 200;

        $this->ProgressBar->updateUI('#efefef',"#007196",2,10,3000,$this->height,true);
        $this->ProgressBar->drawProgress(1);

        $this->btnUpdateValue = AppSpecificFunctions::getNewActionButton($this,'Update','btn btn-default','updateValue');
        $this->txtValueToUpdate = new QTextBox($this);
        $this->txtValueToUpdate->Name = 'Value';
        $this->txtValueToUpdate->Placeholder = '0 - 1';
    }
    protected function updateValue() {
        //$this->ProgressBar->updateUI('#efefef',"#007196",2,10,3000,$this->height,true);
        $this->ProgressBar->drawProgress($this->txtValueToUpdate->Text);
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
ProgressBarsForm::Run('ProgressBarsForm');
?>