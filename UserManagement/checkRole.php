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

function checkRole($requiredRole = array()) {
    if (isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"])) {
        if (!isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_UserRoleId'])) {
            return false;
        } else {
            $currentUserrole = UserRole::LoadById($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"])->Role;
            $bResult = false;
            foreach ($requiredRole as $aRole) {
                if ($currentUserrole ==  $aRole)
                    $bResult = true;
            }          
            if ($bResult)
                return true;
            else {
                return false;
            }
        }
    }
    return false;
}

?>