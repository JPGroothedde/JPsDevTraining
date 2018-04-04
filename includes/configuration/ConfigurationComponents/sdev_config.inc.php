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
if (!defined('SERVER_INSTANCE')) {
	define('SERVER_INSTANCE', 'sdevbase');
}
define('__INCLUDES__', __DOCROOT__ . __SUBDIRECTORY__ . '/includes');
define('__CONFIGURATION__', __INCLUDES__. '/configuration');
define('__EXTERNAL_LIBRARIES__', __INCLUDES__ . '/external_libraries');
define('__APP_INCLUDES__', __INCLUDES__ . '/app_includes');
define('__URL_REWRITE__', 'apache');
define('__QCUBED__', __INCLUDES__ . '/qcubed');
define('__PLUGINS__', __QCUBED__ . '/plugins');
define('__CACHE__', __INCLUDES__ . '/tmp/cache');
define('__QCUBED_CORE__', __INCLUDES__ . '/qcubed/_core');
define('__JS_ASSETS__', __SUBDIRECTORY__ . '/assets/_core/js');
define('__CSS_ASSETS__', __SUBDIRECTORY__ . '/assets/_core/css');
define('__IMAGE_ASSETS__', __SUBDIRECTORY__ . '/assets/_core/images');
define('__PHP_ASSETS__', __SUBDIRECTORY__ . '/assets/_core/php');
define('__PLUGIN_ASSETS__', __SUBDIRECTORY__ . '/assets/plugins');
define('__APP_JS_ASSETS__', __SUBDIRECTORY__ . '/assets/js');
define('__APP_CSS_ASSETS__', __SUBDIRECTORY__ . '/assets/css');
define('__APP_IMAGE_ASSETS__', __SUBDIRECTORY__ . '/assets/images');
define('__APP_PHP_ASSETS__', __SUBDIRECTORY__ . '/assets/php');
define('__JQUERY_BASE__', __APP_JS_ASSETS__.'/jquery/1.11.1/jquery.min.js');
define('__JQUERY_EFFECTS__',  __APP_JS_ASSETS__.'/jquery/UI/1.11.4/jquery-ui.min.js');
define('__JQUERY_CORE_VERSION__', '1.11.1');
define('__JQUERY_UI_VERSION__', '1.11.4');
define('__QCUBED_JS_CORE__',  'qc_sdev_wrapper.js');
define('__JQUERY_CSS__', 'jquery-ui-themes/ui-qcubed/jquery-ui.custom.css');
define('__DEVTOOLS__', __PHP_ASSETS__ . '/_devtools');
define('__EXAMPLES__', __PHP_ASSETS__ . '/examples');
define('__QI18N_PO_PATH__', __QCUBED__ . '/i18n');
define('__DBMNG__', __SUBDIRECTORY__ .'/DatabaseManagement');
define('__SIMPLE_ENHANCEMENTS__', __DOCROOT__.__SUBDIRECTORY__ .'/SimpleEnhancements');
define('__PAGE_CONTROL__', __DOCROOT__.__SUBDIRECTORY__ .'/PageControl');
define('__PHPMailer__',  __DOCROOT__ .__SUBDIRECTORY__ . '/PHPMailer');
define('__SDEV_CONTROLS__', __DOCROOT__.__SUBDIRECTORY__ .'/sDevControls');
define('__SDEV_ORM__',__DOCROOT__.__SUBDIRECTORY__.'/sDevORM');
define('__SDEV_FUNCTIONS__', __DOCROOT__.__SUBDIRECTORY__ .'/sDevFunctions');
define('__VIRTUAL_SDEV_ORM__',__VIRTUAL_DIRECTORY__.__SUBDIRECTORY__.'/sDevORM');
define('__MODEL__', __SDEV_ORM__ . '/DatabaseModel' );
define('__MODEL_GEN__', __MODEL__ . '/generated' );
define('__USRMNG__', __SUBDIRECTORY__ .'/UserManagement');
define('__FILE_UPLOADED_PATH__',  __SUBDIRECTORY__ . '/App/uploaded/');
define('__FILE_UPLOADED_PATH_SUMMERNOTE__',  __SUBDIRECTORY__ . '/App/uploaded/summernote_uploads/');
// If using the QDbBackedSessionHandler, define the DB index where the table to store the formstates is present
define('__DB_BACKED_FORM_STATE_HANDLER_DB_INDEX__', 1);
// If using QDbBackedSessionHandler, specify the table name which would hold the formstates (must meet the requirements laid out above)
define('__DB_BACKED_FORM_STATE_HANDLER_TABLE_NAME__', 'qc_formstate');
/*
     * sDev allows you to save / read / write your user PHP sessions in a database.
     * This is immensely helpful when you want to develop your sDev based application
     * to support running on two different web servers with same data backends or with load balancing.
     * If you are using QSessionFormStateHandler, it also automatically centralizes your formstates.
     *
     * To avail this feature, you must have a dedicated table in one of your databases above.
     * The table must have 3 columns with follwing names and datatypes (note that column names should match exactly):
     *
     * [Column 1]
     *      Name = id
     *      Data Type = varchar / character varying with length of 32 characters (varchar(32))
     *
     * [Column 2]
     *      Name = last_access_time
     *      Data type = integer
     *
     * [Column 3]
     *      Name = data
     *      Data type = text
     *
     * For this to work, we need to know two things:
     * 1. The DB_CONNECTION index (repeat: the numerical index) of the database from the list of databases above
     *          where this table is located.
     * 2. The name of the table in  the database.
     *
     * Notes:
     * 1. if you do not want to use this feature, set the value of DB_BACKED_SESSION_HANDLER_DB_INDEX to 0.
     * 2. It is recommended that you create a primary key on the 'id' field and an index on the 'last_access_time' field
     *      to speed up the database queries.
     * 3. This feature does not make use of the codegen feature. So you may exclude this table from being codegened.
     */
define('__FORM_STATE_HANDLER__', 'QFormStateHandler');
// If using the QFileFormStateHandler, specify the path where sDev will save the session state files (has to be writeable!)
define('__FILE_FORM_STATE_HANDLER_PATH__', __INCLUDES__ . '/tmp');
// The database index where the Session storage tables are present. Remember, define it as an integer.
define("DB_BACKED_SESSION_HANDLER_DB_INDEX", 0);
// The table name to be used for session data storage (must meet the requirements laid out above)
define("DB_BACKED_SESSION_HANDLER_TABLE_NAME", "qc_session");
// Define the Filepath for any logged errors
define('ERROR_LOG_PATH', __INCLUDES__ . '/error_log');
?>
