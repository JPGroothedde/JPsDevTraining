<?php
// Load the sDev Development Framework
require('../sdev.inc.php');

if (isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"]))
{
    if (!isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_UserRoleId']))
    {
        unset($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_AccountId']);
    }
    else
    {
        $userRole = UserRole::LoadById($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"])->Role;
        AppSpecificFunctions::Redirect('../App/'. $userRole.'/');
    }
}

class AnonIndexForm extends QForm {
    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->checkPersistantLogin();
        $this->initHomePage();
    }
    protected function initHomePage() {
        // Either display content here or redirect to login page
        AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'/UserManagement/login/');
    }

    protected function checkPersistantLogin() {
        if (isset($_COOKIE[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)])) {
            $objLoginToken = LoginToken::LoadByLoginToken($_COOKIE[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)]);
            if ($objLoginToken) {
                $objAccount = $objLoginToken->AccountObject;
                if ($objAccount) {
                    // Here we will set the session variables AccountId and Userrole
                    $_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"] = $objAccount->Id;
                    $_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"] = $objAccount->UserRoleObject->Id;
                    AppSpecificFunctions::Redirect(__USRMNG__);
                }
            }
        }
    }

}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
AnonIndexForm::Run('AnonIndexForm');
?>