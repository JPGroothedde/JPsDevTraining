<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 310715
 * Time: 10:59
 */
require('../../sdev.inc.php');
// Database connection string checks
for ($i = 1; $i < 1 + sizeof(QApplication::$Database); $i++) {
    if (!isset(QApplication::$Database[$i]))
        continue;
    $db = QApplication::$Database[$i];
    // database connection problems are PHP Errors, not exceptions
    // using an intermediate error handler to make them into
    // exceptions so that we can catch them locally
    set_error_handler("__database_check_error");
    try {
        $db->Connect();
        echo 'All Good!';
    } catch (Exception $e) {
        /*$obj = new QInstallationValidationResult();
        $obj->strMessage = "Fix database configuration settings in " .
            __CONFIGURATION__ . "/configuration.inc.php for adapter #"
            . $i . ": " . $e->getMessage();
        $result[] = $obj;*/
        echo 'Cannot Connect!';
    }
    restore_error_handler();
}

function __database_check_error($errno, $errstr, $errfile, $errline, $errcontext) {
    throw new Exception(strip_tags($errstr));
}
?>