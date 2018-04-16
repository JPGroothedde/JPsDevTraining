<?php
if (!defined('SERVER_INSTANCE')) {
	// The Server Instance constant is used to help ease web applications with multiple environments.
	define('SERVER_INSTANCE', 'sdevbase');
}
/*
 *  Constant to keep the provided license key. This needs to be the same as the license obtained from Stratusolve (Pty) Ltd in order for your application to work
 */
define('SDEV_LICENSE','UpQPHWzVrIfSm0eFNOD8c2jkGJTv439RaMiu7Ybn5h6gBwtAyqsCZX1ldExoLK');

switch (SERVER_INSTANCE) {
	case 'sdevbase':
		/* Constant to allow/disallow remote access to the admin pages
		* Call AppSpecificFunctions::CheckRemoteAdmin() on any pages that should not be executable remotely
		* If set to TRUE, anyone can access those pages.
		* If set to FALSE, only localhost can access those pages.
		* If set to an IP address (e.g. "12.34.56.78"), then only localhost and 12.34.56.78 can access those pages.
		* If set to a comma-separate list of IP addresses, then localhoost and any of those IP addresses can access those pages.
		*
		* Of course, you can also feel free to remove AppSpecificFunctions::CheckRemoteAdmin() call on any of these pages,
		* which will completely ignore ALLOW_REMOTE_ADMIN altogether.
		*/
		define('ALLOW_REMOTE_ADMIN', true);
		/*
		 * Constant to enable/disable the developer help menu on the right
		 */
		define('DEV_MODE', true);
		/* Constants for Document Root (and Virtual Directories / Subfoldering)
		 *
		 * Please specify the "Document Root" here.  This is the top level filepath for your web application.
		 * If you are on a installation that uses virtual directories, then you must specify that here, as well.
		 *
		 * For example, if your example web application where http://my.domain.com/index.php points to
		 * /home/web/htdocs/index.php, then you must specify:
		 *		__DOCROOT__ is defined as '/home/web/htdocs'
		 *		(note the leading slash and no ending slash)
		 *
		 * Next, if you are using Virtual Directories, where http://not.my.domain.com/~my_user/index.php
		 * (for example) points to /home/my_user/public_html/index.php, then:
		 *		__DOCROOT__ is defined as '/home/my_user/public_html'
		 *		__VIRTUAL_DIRECTORY__ is defined as '/~my_user'
		 *
		 * Finally, if you have installed sDev-Release within a SubDirectory of the Document Root, so for example
		 * the sDev "index.php" page is accessible at http://my.domain.com/frameworks/sdev/index.php, then:
		 *		__SUBDIRECTORY__ is defined as '/frameworks/sdev'
		 *		(again, note the leading and no ending slash)
		 *
		 * In combination with Virtual Directories, if you (for example) have the sDev "index.php" page
		 * accessible at http://not.my.domain.com/~my_user/sDev/index.php, and the index.php resides at
		 * c:\users\my_user\public_html\index.php, then:
		 *		__DOCROOT__ is defined as 'c:/users/my_user/public_html'
		 *		__VIRTUAL_DIRECTORY__ is defined as '/~my_user'
		 *		__SUBDIRECTORY__ is defined as '/sdev'
		 *      /var/www/sdev/wwwroot
		 *
		 * For hetzner linux servers
		 * /usr/www/users/ftp_user
		 *
		 */
		define ('__DOCROOT__', '/opt/lampp/htdocs');
		define ('__VIRTUAL_DIRECTORY__', '');
		define ('__SUBDIRECTORY__', '/JPsDevTraining');
		// The App name
		define ('__APPNAME__','sDev-Base');
		/* Database Connection SerialArrays
		 *
		 * Note that all Database Connections are defined as constant serialized arrays.  sDev supports
		 * connections to an unlimited number of different database sources.  Each database source, referenced by
		 * a numeric index, will have its DB Connection SerialArray stored in a DB_CONNECTION_# constant
		 * (where # is the numeric index).
		 *
		 * The SerialArray can have the following keys:
		 * "adapter" (Required), options are:
		 *		MySqli5 (MySQL v5.x, using the new mysqli extension)
		 * "server" (Required) is the db server's name or IP address, e.g. localhost, 10.1.1.5, etc.
		 * "port" is the port number - default is the server-specified default
		 * "database", "username", "password" should be self explanatory
		 * "dateformat" is an optional value for the desired db date format, the default value is
		 *		'YYYY-MM-DD hhhh:mm:ss' if not defined or null
		 * "profiling" is true or false, defining whether or not you want to enable DB profiling - default is false
		 *		NOTE: Profiling should only be enabled when you are actively wanting to profile a
		 *		specific PHP script or scripts.  Because of SIGNIFICANT performance degradation,
		 *		it should otherwise always be OFF.
		 * "ScriptPath": you can have CodeGen virtually add additional FKs, even though they are
		 * 		not defined as a DB constraint in the database, by using a script to define what
		 * 		those constraints are.  The path of the script can be defined here. - default is blank or none
		 * Note: any option not used or set to blank will result in using the default value for that option
		 */
		define('DB_CONNECTION_1', serialize(array(
			'adapter' => 'MySqli5',
			'server' => 'localhost',
			'port' => null,
			'database' => 'socialMedia',
			'username' => 'sdevbase',
			'password' => '123',
			'caching' => false,
			'profiling' => false)));
		// Additional Database Connection Strings can be defined here (e.g. for connection #2, #3, #4, #5, etc.)
		//			define('DB_CONNECTION_2', serialize(array('adapter'=>'SqlServer', 'server'=>'localhost', 'port'=>null, 'database'=>'sDev', 'username'=>'root', 'password'=>'', 'profiling'=>false)));
		//			define('DB_CONNECTION_3', serialize(array('adapter'=>'MySqli', 'server'=>'localhost', 'port'=>null, 'database'=>'sDev', 'username'=>'root', 'password'=>'', 'profiling'=>false)));
		//			define('DB_CONNECTION_4', serialize(array('adapter'=>'MySql', 'server'=>'localhost', 'port'=>null, 'database'=>'sDev', 'username'=>'root', 'password'=>'', 'profiling'=>false)));
		//			define('DB_CONNECTION_5', serialize(array('adapter'=>'PostgreSql', 'server'=>'localhost', 'port'=>null, 'database'=>'sDev', 'username'=>'root', 'password'=>'', 'profiling'=>false)));
		//			define('DB_CONNECTION_6', serialize(array('adapter' => 'InformixPdo', 'host' => 'maxdata', 'server' => 'maxdata', 'service' => 9088, 'protocol' => 'onsoctcp', 'database' => 'sDev', 'username' => 'root', 'password' => '', 'profiling' => false)));
		// Maximum index of the DB connections defined by DB_CONNECTION_# constants above
		// When reading the DB_CONNECTION_# constants, it will only go up to (and including) the index defined here
		// See ApplicationBase::InitializeDatabaseConnections()
		define ('MAX_DB_CONNECTION_INDEX', 9);
		define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_page.php');
		//define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_pagePROD.php');
		break;
	case 'appdev':
		define('ALLOW_REMOTE_ADMIN', true);
		define('DEV_MODE', true);
		// Define the Filepath for the error page (path MUST be relative from the DOCROOT)
		define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_page.php');
		//define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_pagePROD.php');
		break;
	case 'appaccp':
		define('ALLOW_REMOTE_ADMIN', true);
		define('DEV_MODE', true);
		// Define the Filepath for the error page (path MUST be relative from the DOCROOT)
		define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_page.php');
		//define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_pagePROD.php');
		break;
	case 'appstage':
		define('ALLOW_REMOTE_ADMIN', true);
		define('DEV_MODE', true);
		// Define the Filepath for the error page (path MUST be relative from the DOCROOT)
		define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_page.php');
		//define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_pagePROD.php');
		break;
	case 'appprod':
		define('ALLOW_REMOTE_ADMIN', false);
		define('DEV_MODE', false);
		// Define the Filepath for the error page (path MUST be relative from the DOCROOT)
		//define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_page.php');
		define('ERROR_PAGE_PATH', __SUBDIRECTORY__ . '/assets/_core/php/error_pagePROD.php');
		break;
}
// The persistant login token
define ('__LOGINTOKEN__',__APPNAME__.'_AppToken');
// The Maintenence password for this app. This is used to setup the initial Admin account
define ('__MAINTENANCEPWD__','123456');
// This allows remote access to controlled scripts
define ('__ALLOW_REMOTE_ADMIN_VIA_MAINTENANCEPWD__',true);
// The Email server to use for sending emails
define('__SMTP_SERVER__', '');
define('__SMTP_PORT__', 587);
define('__SMTP_USER__', '');
define('__SMTP_PASSWORD__', '');
define('__SMTP_AUTHPLAIN__', true);
// (For PHP > v5.1) Setup the default timezone (if not already specified in php.ini)
if ((function_exists('date_default_timezone_set')) && (!ini_get('date.timezone')))
	date_default_timezone_set('Africa/Johannesburg');
/*define ('DATE_TIME_FORMAT_JS','dd-mm-yy');
define ('DATE_TIME_FORMAT_PHP','DD-MM-YYYY');
define ('DATE_TIME_FORMAT_HTML','d-m-Y');*/
define ('DATE_TIME_FORMAT_JS','dd-M-yy');
define ('DATE_TIME_FORMAT_PHP','DD-MMM-YYYY');
define ('DATE_TIME_FORMAT_HTML','d-M-Y');
define ('__DEFAULT_USER_ROLE__','User');
define('__QAPPLICATION_ENCODING_TYPE__', 'UTF-8');
/*
     * Caching support for sDev
     * Determines which class as a Cache Provider. It should be a subclass of QAbstractCacheProvider.
     * Setting it to null will disable caching. Current implentations are
     *
     * "QCacheProviderMemcache": this will use Memcache as the caching provider.
     *   You must have the 'php5-memcache' package installed for this provider to work.
     *
     * "QCacheProviderLocalMemory": a local memory cache provider with a lifespan of the request
     *   or session (if KeepInSession is configured).
     *
     * "QCacheProviderNoCache": provider which does no caching at all
     *
     * "QMultiLevelCacheProvider": a provider that can combine multiple providers into one.
     *   This can be used for example to combine the LocalMemory cache provider with the Memcache based provider.
     */
define("CACHE_PROVIDER_CLASS", null);

/*
 * Options passed to the constructor of the Caching Provider class above.
 * For QCacheProviderMemcache, it's an array, where each item is an associative array of
 * server configuration options.
 * Please see the documentation for the constructor for each provider for a description of the accepted
 * options.
 */
define ('CACHE_PROVIDER_OPTIONS' , serialize(
	array(
		array('host' => '127.0.0.1', 'port' => 11211, ),
		//array('host' => '10.0.2.2', 'port' => 11211, ), // adds a second server
	)
) );

/* Form State Handler. Determines which class is used to serialize the form in-between Ajax callbacks.
     *
     * Possible values are:
     * "QFormStateHandler": This is the "standard" FormState handler, storing the base64 encoded session data
     *	(and if requested by QForm, encrypted) as a hidden form variable on the page, itself.
     *
     * "QSessionFormStateHandler": Simple Session-based FormState handler.  Uses PHP Sessions so it's very straightforward
     *	and simple, utilizing the session handling and cleanup functionality in PHP, itself.
     *	The downside is that for long running sessions, each individual session file can get
     *	very, very large, storing all the various formstate data.  Eventually (if individual
     *	session files are larger than 10MB), you can theoretically observe a geometrical
     *	degradation of performance.
     *
     * "QFileFormStateHandler": This will store the formstate in a pre-specified directory (__FILE_FORM_STATE_HANDLER_PATH__)
     *	on the file system. This offers significant speed advantage over PHP SESSION because EACH
     *	form state is saved in its own file, and only the form state that is needed for loading will
     *	be accessed (as opposed to with session, ALL the form states are loaded into memory
     *	every time).
     *	The downside is that because it doesn't utilize PHP's session management subsystem,
     *	this class must take care of its own garbage collection/deleting of old/outdated
     *	formstate files.
     *
     * "QDbBackedFormStateHandler": This will store the formstate in a predefined table in one of the DBs in the array above.
     *    It provides a way to maintain the FormStates without creating too many files on the server.
     *    It also makes sure that the application remains fast and provides all the features of QFileFormStateHandler.
     *    The algorithm to periodically clean up the DB is also provided (just like QFileFormStateHandler) .
     *
     *    To use the QDbBackedFormStateHandler, the following two constants must be defined:
     *       1. __DB_BACKED_FORM_STATE_HANDLER_DB_INDEX__ : It is the numerical index of the DB from the list of DBs defined
     *             above where the table to store the FormStates is present. Note, it is the numerical Index, not the DB name.
     *             e.g. If it is present in the DB_CONNECTION_1, then the value must be defined as '1'.
     *       2. __DB_BACKED_FORM_STATE_HANDLER_TABLE_NAME__ : It is the name of the table where the FormStates must be stored
     *              It must have following 4 columns:
     *                  i) page_id: varchar(80) - It must be the primary key.
     *                 ii) save_time: integer - This column should be indexed for performance reasons
     *                iii) session_id: varchar(32) - This column should be indexed for performance reasons
     *                 iv) state_data: text - This column must NOT be indexed otherwise it will degrade the performance.
     *
     * NOTE: Formstates can be large, depending on the complexity of your forms.
     *       For MySQL, you might have to increase the max_allowed_packet variable in your my.cnf file to the maximum size of a formstate.
     *       Also for MySQL, you should choose a MEDIUMTEXT type of column, rather than TEXT. TEXT is limited to 64KB,
     *       which will not be big enough for moderately complex forms, and will result in data errors.
     */
// To Log ALL errors that have occurred, set flag to true
define('ERROR_LOG_FLAG', true);
// To enable the display of "Friendly" error pages and messages, define them here (path MUST be relative from the DOCROOT)
define('ERROR_FRIENDLY_AJAX_MESSAGE', 'Oops!  An error has occurred.\r\n\r\nThe error was logged, and we will take a look at this right away.');
define('ALLOW_BACK_BUTTON',true);
define('PROMPT_STANDALONE_MODE',false);
define('__SYSTEM_PHP_PATH__','/usr/bin/php');
?>
