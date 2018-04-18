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
set_time_limit(7200); // This script could take some time to run...
require('../includes/configuration/configuration.inc.php');
if (isset($_GET['auth'])) {
    if ($_GET['auth'] != urldecode(__MAINTENANCEPWD__))
        die('No Authorization');
} else
    die('No Authorization');

$dbArray = unserialize(DB_CONNECTION_1);
$host = $dbArray['server'];
$username = $dbArray['username'];
$password = $dbArray['password'];
$db_name = $dbArray['database'];
$filename = 'Backups/'.__APPNAME__.'-db-backup-'.time().'.sql';
if (isset($_GET['f'])) {
    $filename = 'Backups/'.$_GET['f'].'.sql';
}

echo backupDB($db_name,$host,$username,$password,$filename);
function backupDB($dbname,$dbhost,$dbuser,$dbpass,$filename) {
    if (isAvailable('system')) {
        try {
            $mysqldumpLocation = detect_mysqldump_location();
            $backup_file = $filename;
            $command = "$mysqldumpLocation --opt -h$dbhost -u$dbuser -p$dbpass $dbname > $backup_file";

            $result = system($command,$retval);
            //return $retval;
            if ($retval == 0)
                return 'Success!';
            else {
                if ($retval == 2) {
                    return 'Backup failed! Incorrect DB settings.';
                }
                return 'Backup failed! Reason unknown.';
            }
        } catch (RuntimeException $e) {
            return 'Failed! '.$e->getMessage();
        }
    } else {
        return 'Failed! Function "system" is not available';
    }
}
function detect_mysqldump_location() {

    // 1st: use mysqldump location from `which` command.
    $mysqldump = `which mysqldump`;
    if (is_executable($mysqldump)) return $mysqldump;

    // 2nd: try to detect the path using `which` for `mysql` command.
    $mysqldump = dirname(`which mysql`) . "/mysqldump";
    if (is_executable($mysqldump)) return $mysqldump;

    // 3rd: detect the path from the available paths.
    // you can add additional paths you come across, in future, here.
    $available = array(
        '/usr/bin/mysqldump', // Linux
        '/usr/local/mysql/bin/mysqldump', //Mac OS X
        '/usr/local/bin/mysqldump', //Linux
        '/usr/mysql/bin/mysqldump' //Linux
    );
    foreach($available as $apath) {
        if (is_executable($apath)) return $apath;
    }

    // 4th: auto detection has failed!
    // lets, throw an exception, and ask the user to provide the path instead, manually.
    $message  = "Path to \"mysqldump\" binary could not be detected!\n";
    $message .= "Please, specify it inside the configuration file provided!";
    throw new RuntimeException($message);
}
function isAvailable($func) {
    if (ini_get('safe_mode')) return false;
    $disabled = ini_get('disable_functions');
    if ($disabled) {
        $disabled = explode(',', $disabled);
        $disabled = array_map('trim', $disabled);
        return !in_array($func, $disabled);
    }
    return true;
}
?>