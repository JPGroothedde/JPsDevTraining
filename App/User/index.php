<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

//if (!checkRole(array('User')))
//    AppSpecificFunctions::Redirect(__USRMNG__.'/login/');

class UserIndexForm extends QForm {
    public function Form_Create() {
        parent::Form_Create();
        $CurrentAccount = Account::Load(AppSpecificFunctions::getCurrentAccountAttribute()); // CORRECT
        $CurrentAccount = getCurrentAccount(); // WRONG
    }
}
UserIndexForm::Run('UserIndexForm');

?>