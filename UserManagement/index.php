<?php
// Load the sDev Development Framework
require('../sdev.inc.php');

if (isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"]))
{
    if (!isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_UserRoleId']))
    {
        unset($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_AccountId']);
        QApplication::Redirect(__USRMNG__.'/login/');
    }
    else
    {
        // We need to create functionality that will check the default homepage for
        // a user role here. Then redirect to that page
        // QApplication::Redirect('');
        //$fullName = Account::LoadById($_SESSION["AccountId"])->Fullname;
        //$role = Userrole::LoadById($_SESSION["UserRoleId"])->Role;
       // QApplication::DisplayAlert('Logged in with '.$fullName.'. Your user role is '.$role);


        //Check if there are release notes to show. If so, Redirect to the release notes section.
        //If not, simply continue...
        //The release notes section will then handle the continuing behaviour if needed
        $theAccount = Account::Load($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"]);
        if ($theAccount) {
            $userRole = UserRole::LoadById($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"])->Role;
            QApplication::Redirect('../App/'. $userRole.'/');
        }
    }
}
else {
    // If the user is not authenticated, we redirect them to the anonymous home page
    // For phase 1 we will redirect to the login page
    QApplication::Redirect(__SUBDIRECTORY__.'/');
    //QApplication::Redirect('../App/');
}
?>
