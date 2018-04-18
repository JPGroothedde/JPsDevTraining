<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PlaceHolder/PlaceHolderController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class DragAndDropForm extends QForm {
    protected $lblHandle;
    protected $txtTextbox;
    protected $pnlParent;
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        $this->pnlParent = new QPanel($this);
        $this->pnlParent->AutoRenderChildren = true;

        $this->lblHandle = new QPanel($this->pnlParent);
        $this->lblHandle->Text = 'Please Enter your Name';
        $this->lblHandle->Cursor = 'move';
        $this->lblHandle->BackColor = '#333333';
        $this->lblHandle->ForeColor = '#FFFFFF';
        $this->lblHandle->Width = '250px';
        $this->lblHandle->Padding = '4';

        $this->txtTextbox = new QTextBox($this->pnlParent);
        $this->txtTextbox->Width = '250px';

        // Let's assign the panel as a moveable control, handled
        // by the label.
        $this->pnlParent->Moveable = true;
        $this->pnlParent->DragObj->Handle = $this->lblHandle;
    }
}
DragAndDropForm::Run('DragAndDropForm');
?>