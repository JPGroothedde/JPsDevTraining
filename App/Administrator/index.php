<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
if (!checkRole(array('Administrator')))
    AppSpecificFunctions::Redirect(__USRMNG__.'/login/');

    class AdminHomeForm extends QForm {
        // Override Form Event Handlers as Needed
        public function Form_Create() {
            parent::Form_Create();
            AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'/App/Administrator/Account_Overview');
        }
    }
    AdminHomeForm::Run('AdminHomeForm');
?>
