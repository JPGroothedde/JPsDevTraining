<?php
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
require('../sdev.inc.php');
$objAccount = null;
if (isset($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"]))
    $objAccount = Account::LoadById($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"]);
if ($objAccount) {
    $objLoginToken = LoginToken::QueryArray(QQ::Equal(QQN::LoginToken()->AccountObject->Id,$objAccount->Id));
    foreach ($objLoginToken as $lt) {
        $lt->Delete();
        setcookie(AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__), '', time()-1000);
        setcookie(AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__), '', time()-1000, '/');
    }
}
session_destroy();
AppSpecificFunctions::Redirect(__USRMNG__);
?>
