<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require('sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
switch (SERVER_INSTANCE) {
    case 'sdevbase':
        if (ALLOW_REMOTE_ADMIN)
            QApplication::Redirect(__SUBDIRECTORY__.'/assets/_core/php/_devtools/start_page.php');
        else
            QApplication::Redirect(__SUBDIRECTORY__.'/App/');
        break;
    case 'appdev':
        if (ALLOW_REMOTE_ADMIN)
            QApplication::Redirect(__SUBDIRECTORY__.'/assets/_core/php/_devtools/start_page.php');
        else
            QApplication::Redirect(__SUBDIRECTORY__.'/App/');
        break;
    case 'apptest':
        if (ALLOW_REMOTE_ADMIN)
            QApplication::Redirect(__SUBDIRECTORY__.'/assets/_core/php/_devtools/start_page.php');
        else
            QApplication::Redirect(__SUBDIRECTORY__.'/App/');
        break;
    case 'appstage':
        if (ALLOW_REMOTE_ADMIN)
            QApplication::Redirect(__SUBDIRECTORY__.'/assets/_core/php/_devtools/start_page.php');
        else
            QApplication::Redirect(__SUBDIRECTORY__.'/App/');
        break;
    case 'appprod':
        if (ALLOW_REMOTE_ADMIN)
            QApplication::Redirect(__SUBDIRECTORY__.'/assets/_core/php/_devtools/start_page.php');
        else
            QApplication::Redirect(__SUBDIRECTORY__.'/App/');
        break;
}
QApplication::Redirect(__SUBDIRECTORY__.'/App/');
//QApplication::Redirect(__SUBDIRECTORY__.'/UserManagement/login.php');

