<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Load the sDev Development Framework
require('../sdev.inc.php');

    class ErrorForm extends QForm {
        protected $sh_TheError;
        public function Form_Create() {
            parent::Form_Create();
            $this->sh_TheError = new SimpleHTML($this);
            if (isset($_GET['c'])) {
                switch ($_GET['c']) {
                    case '1':
                        $this->sh_TheError->SetControlHtml('<strong>Error! </strong>There is no company associated with your account.
                            Please contact your company administrator for assistance');
                        break;
                    default:
                        $this->sh_TheError->SetControlHtml('<strong>Error! </strong>An unknown error has occured. Please log out and log back in.');
                }
                
            } else {
                $this->sh_TheError->SetControlHtml('<strong>Error! </strong>An unknown error has occured. Please log out and log back in.');
            }

        }
    }
    ErrorForm::Run('ErrorForm');
?>
