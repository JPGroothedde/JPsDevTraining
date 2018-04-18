<?php
/**
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
/**
 * This abstract class should never be instantiated.  It contains static methods,
 * variables and constants to be used throughout the application.
 *
 * The static method "Initialize" should be called at the begin of the script by
 * prepend.inc.
 */
abstract class QApplicationBase extends QBaseClass {
	//////////////////////////
	// Public Static Variables
	//////////////////////////
	
	/**
	 * The cache provider object used for caching ORM objects
	 * It is initialized below in Initialize(), based on the CACHE_PROVIDER and CACHE_PROVIDER_OPTIONS
	 * variables defined in configuration.inc.php
	 *
	 * @var QAbstractCacheProvider
	 */
	public static $objCacheProvider = null;
	
	/**
	 * Internal bitmask signifying which BrowserType the user is using
	 * Use the QApplication::IsBrowser() method to do browser checking
	 *
	 * @var integer BrowserType
	 */
	protected static $BrowserType = QBrowserType::Unsupported;
	
	/**
	 * Definition of CacheControl for the HTTP header.  In general, it is
	 * recommended to keep this as "private".  But this can/should be overriden
	 * for file/scripts that have special caching requirements (e.g. dynamically
	 * created images like QImageLabel).
	 *
	 * @var string CacheControl
	 */
	public static $CacheControl = 'private';
	
	/**
	 * @var #P#C\QCrossScripting.Purify|?
	 * Defines the default mode for controls that need protection against
	 * cross-site scripting. Can be overridden at the individual control level,
	 * or for all controls by overriding it in QApplication.
	 *
	 * Set to QCrossScripting::Legacy for backward compatibility reasons for legacy applications;
	 * For new applications the recommended setting is QCrossScripting::Purify.
	 */
	public static $DefaultCrossScriptingMode = QCrossScripting::Legacy;
	
	/**
	 * Path of the "web root" or "document root" of the web server
	 * Like "/home/www/htdocs" on Linux/Unix or "c:\inetpub\wwwroot" on Windows
	 *
	 * @var string DocumentRoot
	 */
	public static $DocumentRoot;
	
	/**
	 * Whether or not we are currently trying to Process the Output of the page.
	 * Used by the OutputPage PHP output_buffering handler.  As of PHP 5.2,
	 * this gets called whenever ob_get_contents() is called.  Because some
	 * classes like QFormBase utilizes ob_get_contents() to perform template
	 * evaluation without wanting to actually perform OutputPage, this flag
	 * can be set/modified by QFormBase::EvaluateTemplate accordingly to
	 * prevent OutputPage from executing.
	 *
	 * @var boolean ProcessOutput
	 */
	public static $ProcessOutput = true;
	
	/**
	 * Full path of the actual PHP script being run
	 * Like "/home/www/htdocs/folder/script.php" on Linux/Unix
	 * or "c:\inetpub\wwwroot" on Windows
	 *
	 * @var string ScriptFilename
	 */
	public static $ScriptFilename;
	
	/**
	 * Web-relative path of the actual PHP script being run
	 * So for "http://www.domain.com/folder/script.php",
	 * QApplication::$ScriptName would be "/folder/script.php"
	 *
	 * @var string ScriptName
	 */
	public static $ScriptName;
	
	/**
	 * Extended Path Information after the script URL (if applicable)
	 * So for "http://www.domain.com/folder/script.php/15/225"
	 * QApplication::$PathInfo would be "/15/255"
	 *
	 * @var string PathInfo
	 */
	public static $PathInfo;
	
	/**
	 * Query String after the script URL (if applicable)
	 * So for "http://www.domain.com/folder/script.php?item=15&value=22"
	 * QApplication::$QueryString would be "item=15&value=22"
	 *
	 * @var string QueryString
	 */
	public static $QueryString;
	
	/**
	 * The full Request URI that was requested
	 * So for "http://www.domain.com/folder/script.php/15/25/?item=15&value=22"
	 * QApplication::$RequestUri would be "/folder/script.php/15/25/?item=15&value=22"
	 *
	 * @var string RequestUri
	 */
	public static $RequestUri;
	
	/**
	 * The IP address of the server running the script/PHP application
	 * This is either the LOCAL_ADDR or the SERVER_ADDR server constant, depending
	 * on the server type, OS and configuration.
	 *
	 * @var string ServerAddress
	 */
	public static $ServerAddress;
	
	/**
	 * The encoding type for the application (e.g. UTF-8, ISO-8859-1, etc.)
	 *
	 * @var string EncodingType
	 */
	public static $EncodingType = "UTF-8";
	
	/**
	 * An array of Database objects, as initialized by QApplication::InitializeDatabaseConnections()
	 *
	 * @var QDatabaseBase[] Database
	 */
	public static $Database;
	
	/**
	 * A flag to indicate whether or not this script is run as a CLI (Command Line Interface)
	 *
	 * @var boolean CliMode
	 */
	public static $CliMode;
	
	/**
	 * Class File Array - used by QApplication::AutoLoad to more quickly load
	 * core class objects without making a file_exists call.
	 *
	 * @var array ClassFile
	 */
	public static $ClassFile;
	
	/**
	 * Preloaded Class File Array - used by QApplication::Initialize to load
	 * any core class objects during Initailize()
	 *
	 * @var array ClassFile
	 */
	public static $PreloadedClassFile;
	
	/**
	 * The QRequestMode enumerated value for the current request mode
	 *
	 * @var string RequestMode
	 */
	public static $RequestMode;
	
	/**
	 * 2-letter country code to set for internationalization and localization
	 * (e.g. us, uk, jp)
	 *
	 * @var string CountryCode
	 */
	public static $CountryCode;
	
	/**
	 * 2-letter language code to set for internationalization and localization
	 * (e.g. en, jp, etc.)
	 *
	 * @var string LanguageCode
	 */
	public static $LanguageCode;
	
	/**
	 * The instance of the active QI18n object (which contains translation strings), if any.
	 *
	 * @var QTranslationBase $LanguageObject
	 */
	public static $LanguageObject;
	
	////////////////////////
	// Public Overrides
	////////////////////////
	/**
	 * This faux constructor method throws a caller exception.
	 * The Application object should never be instantiated, and this constructor
	 * override simply guarantees it.
	 *
	 * @return \QApplicationBase
	 */
	public final function __construct() {
		throw new QCallerException('Application should never be instantiated.  All methods and variables are publically statically accessible.');
	}
	
	
	////////////////////////
	// Public Static Methods
	////////////////////////
	
	/**
	 * This should be the first call to initialize all the static variables
	 * The application object also has static methods that are miscellaneous web
	 * development utilities, etc.
	 *
	 * @return void
	 */
	public static function Initialize() {
		self::$EncodingType = defined('__QAPPLICATION_ENCODING_TYPE__') ? __QAPPLICATION_ENCODING_TYPE__ : self::$EncodingType;
		
		$strCacheProviderClass = 'QCacheProviderNoCache';
		if (defined('CACHE_PROVIDER_CLASS')) {
			$strCacheProviderClass = CACHE_PROVIDER_CLASS;
		}
		if ($strCacheProviderClass) {
			if (defined('CACHE_PROVIDER_OPTIONS')) {
				QApplicationBase::$objCacheProvider = new $strCacheProviderClass(unserialize(CACHE_PROVIDER_OPTIONS));
			} else {
				QApplicationBase::$objCacheProvider = new $strCacheProviderClass();
			}
		}
		
		// Are we running as CLI?
		if (PHP_SAPI == 'cli')
			QApplication::$CliMode = true;
		else
			QApplication::$CliMode = false;
		
		// Setup Server Address
		if (array_key_exists('LOCAL_ADDR', $_SERVER))
			QApplication::$ServerAddress = $_SERVER['LOCAL_ADDR'];
		else if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
			QApplication::$ServerAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (array_key_exists('SERVER_ADDR', $_SERVER))
			QApplication::$ServerAddress = $_SERVER['SERVER_ADDR'];
		
		// Setup ScriptFilename and ScriptName
		QApplication::$ScriptFilename = $_SERVER['SCRIPT_FILENAME'];
		QApplication::$ScriptName = $_SERVER['SCRIPT_NAME'];
		
		// Ensure both are set, or we'll have to abort
		if ((!QApplication::$ScriptFilename) || (!QApplication::$ScriptName)) {
			throw new Exception('Error on QApplication::Initialize() - ScriptFilename or ScriptName was not set');
		}
		
		// Setup PathInfo and QueryString (if applicable)
		QApplication::$PathInfo = null;
		if(array_key_exists('PATH_INFO', $_SERVER)) {
			QApplication::$PathInfo = urlencode(trim($_SERVER['PATH_INFO']));
			QApplication::$PathInfo = str_ireplace('%2f', '/', QApplication::$PathInfo);
		}
		QApplication::$QueryString = array_key_exists('QUERY_STRING', $_SERVER) ? $_SERVER['QUERY_STRING'] : null;
		
		// Setup RequestUri
		if (defined('__URL_REWRITE__')) {
			switch (strtolower(__URL_REWRITE__)) {
				case 'apache':
					QApplication::$RequestUri = $_SERVER['REQUEST_URI'];
					break;
				
				case 'none':
					QApplication::$RequestUri = sprintf('%s%s%s',
						QApplication::$ScriptName, QApplication::$PathInfo,
						(QApplication::$QueryString) ? sprintf('?%s', QApplication::$QueryString) : null);
					break;
				
				default:
					throw new Exception('Invalid URL Rewrite type: ' . __URL_REWRITE__);
			}
		} else {
			QApplication::$RequestUri = sprintf('%s%s%s',
				QApplication::$ScriptName, QApplication::$PathInfo,
				(QApplication::$QueryString) ? sprintf('?%s', QApplication::$QueryString) : null);
		}
		
		// Setup DocumentRoot
		QApplication::$DocumentRoot = trim(__DOCROOT__);
		
		// Setup Browser Type
		if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
			$strUserAgent = trim(strtolower($_SERVER['HTTP_USER_AGENT']));
			
			QApplication::$BrowserType = 0;
			
			// INTERNET EXPLORER (supporting versions 6.0, 7.0 and eventually 8.0)
			if (strpos($strUserAgent, 'msie') !== false) {
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::InternetExplorer;
				
				if (strpos($strUserAgent, 'msie 6.0') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::InternetExplorer_6_0;
				else if (strpos($strUserAgent, 'msie 7.0') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::InternetExplorer_7_0;
				else if (strpos($strUserAgent, 'msie 8.0') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::InternetExplorer_8_0;
				else
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Unsupported;
				
				// FIREFOX (supporting versions 1.0, 1.5, 2.0 and eventually 3.0)
			} else if ((strpos($strUserAgent, 'firefox') !== false) || (strpos($strUserAgent, 'iceweasel') !== false)) {
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Firefox;
				$strUserAgent = str_replace('iceweasel/', 'firefox/', $strUserAgent);
				
				if (strpos($strUserAgent, 'firefox/1.0') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Firefox_1_0;
				else if (strpos($strUserAgent, 'firefox/1.5') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Firefox_1_5;
				else if (strpos($strUserAgent, 'firefox/2.0') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Firefox_2_0;
				else if (strpos($strUserAgent, 'firefox/3.0') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Firefox_3_0;
				else
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Unsupported;
				
				// SAFARI (supporting version 2.0 and eventually 3.0 and 4.0)
			} else if (strpos($strUserAgent, 'safari') !== false) {
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Safari;
				
				if (strpos($strUserAgent, 'version/4') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Safari_4_0;
				else if (strpos($strUserAgent, 'version/3') !== false || strpos($strUserAgent, 'safari/52') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Safari_3_0;
				else if (strpos($strUserAgent, 'version/2') !== false || strpos($strUserAgent, 'safari/41') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Safari_2_0;
				else
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Unsupported;
				
				// KONQUEROR (eventually supporting versions 3 and 4)
			} else if (strpos($strUserAgent, 'konqueror') !== false) {
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Konqueror;
				
				if (strpos($strUserAgent, 'konqueror/3') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Konqueror_3;
				else if (strpos($strUserAgent, 'konqueror/4') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Konqueror_4;
				else
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Unsupported;
			}
			
			// OPERA (eventually supporting versions 7, 8 and 9)
			if (strpos($strUserAgent, 'opera') !== false) {
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Opera;
				
				if (strpos($strUserAgent, 'opera/7') !== false || strpos($strUserAgent, 'opera 7') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Opera_7;
				else if (strpos($strUserAgent, 'opera/8') !== false || strpos($strUserAgent, 'opera 8') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Opera_8;
				else if (strpos($strUserAgent, 'opera/9') !== false || strpos($strUserAgent, 'opera 9') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Opera_9;
				else
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Unsupported;
			}
			
			// CHROME (eventually supporting versions 0 and 1)
			if (strpos($strUserAgent, 'chrome') !== false) {
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Chrome;
				
				if (strpos($strUserAgent, 'chrome/0') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Chrome_0;
				else if (strpos($strUserAgent, 'chrome/1') !== false)
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Chrome_1;
				else
					QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Unsupported;
			}
			
			// COMPLETELY UNSUPPORTED
			if (QApplication::$BrowserType == 0)
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Unsupported;
			
			// OS (supporting Windows, Linux and Mac)
			if (strpos($strUserAgent, 'windows') !== false)
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Windows;
			else if (strpos($strUserAgent, 'linux') !== false)
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Linux;
			else if (strpos($strUserAgent, 'macintosh') !== false)
				QApplication::$BrowserType = QApplication::$BrowserType | QBrowserType::Macintosh;
		}
		
		// Preload Class Files
		foreach (QApplication::$PreloadedClassFile as $strClassFile)
			require($strClassFile);
	}
	
	/**
	 * Checks for the type of browser in use by the client.
	 * @static
	 * @param int $intBrowserType
	 * @return int
	 */
	public static function IsBrowser($intBrowserType) {
		return ($intBrowserType & QApplication::$BrowserType);
	}
	
	/**
	 * This call will initialize the database connection(s) as defined by
	 * the constants DB_CONNECTION_X, where "X" is the index number of a
	 * particular database connection.
	 *
	 * @return void
	 */
	public static function InitializeDatabaseConnections() {
		// for backward compatibility, don't use MAX_DB_CONNECTION_INDEX directly,
		// but check if MAX_DB_CONNECTION_INDEX is defined
		$intMaxIndex = defined('MAX_DB_CONNECTION_INDEX') ? constant('MAX_DB_CONNECTION_INDEX') : 9;
		for ($intIndex = 0; $intIndex <= $intMaxIndex; $intIndex++) {
			$strConstantName = sprintf('DB_CONNECTION_%s', $intIndex);
			
			if (defined($strConstantName)) {
				// Expected Keys to be Set
				$strExpectedKeys = array(
					'adapter', 'server', 'port', 'database',
					'username', 'password', 'profiling', 'dateformat'
				);
				
				// Lookup the Serialized Array from the DB_CONFIG constants and unserialize it
				$strSerialArray = constant($strConstantName);
				$objConfigArray = unserialize($strSerialArray);
				
				// Set All Expected Keys
				foreach ($strExpectedKeys as $strExpectedKey)
					if (!array_key_exists($strExpectedKey, $objConfigArray))
						$objConfigArray[$strExpectedKey] = null;
				
				if (!$objConfigArray['adapter'])
					throw new Exception('No Adapter Defined for ' . $strConstantName . ': ' . var_export($objConfigArray, true));
				
				if (!$objConfigArray['server'])
					throw new Exception('No Server Defined for ' . $strConstantName . ': ' . constant($strConstantName));
				
				$strDatabaseType = 'Q' . $objConfigArray['adapter'] . 'Database';
				if (!class_exists($strDatabaseType)) {
					$strDatabaseAdapter = sprintf('%s/database/%s.class.php', __QCUBED_CORE__, $strDatabaseType);
					if (!file_exists($strDatabaseAdapter))
						throw new Exception('Database Type is not valid: ' . $objConfigArray['adapter']);
					require($strDatabaseAdapter);
				}
				
				QApplication::$Database[$intIndex] = new $strDatabaseType($intIndex, $objConfigArray);
			}
		}
	}
	
	/**
	 * @throws QCallerException
	 */
	public static function SessionOverride() {
		// Are we using QDbBackedSessionHandler?
		if (defined("DB_BACKED_SESSION_HANDLER_DB_INDEX") &&
			constant("DB_BACKED_SESSION_HANDLER_DB_INDEX") != 0 && defined("DB_BACKED_SESSION_HANDLER_TABLE_NAME")) {
			// Yes we are going to override PHP's default file based handlers.
			QDbBackedSessionHandler::Initialize(DB_BACKED_SESSION_HANDLER_DB_INDEX, DB_BACKED_SESSION_HANDLER_TABLE_NAME);
		}
	}
	
	/**
	 * This is called by the PHP5 Autoloader.  This static method can be overridden.
	 *
	 * @param $strClassName
	 * @return boolean whether or not a class was found / included
	 */
	public static function Autoload($strClassName) {
		if (isset(QApplication::$ClassFile[strtolower($strClassName)])) {
			require_once (QApplication::$ClassFile[strtolower($strClassName)]);
			return true;
		} else if (file_exists($strFilePath = sprintf('%s/%s.class.php', __INCLUDES__, $strClassName))) {
			require_once ($strFilePath);
			return true;
		} else if (file_exists($strFilePath = sprintf('%s/controls/%s.class.php', __QCUBED__, $strClassName))) {
			require_once ($strFilePath);
			return true;
		}
		
		return false;
	}
	
	/**
	 * Temprorarily overrides the default error handling mechanism.  Remember to call
	 * RestoreErrorHandler to restore the error handler back to the default.
	 *
	 * @param string $strName the name of the new error handler function, or NULL if none
	 * @param integer $intLevel if a error handler function is defined, then the new error reporting level (if any)
	 */
	public static function SetErrorHandler($strName, $intLevel = null) {
		if (!is_null(QApplicationBase::$intStoredErrorLevel))
			throw new QCallerException('Error handler is already currently overridden.  Cannot override twice.  Call RestoreErrorHandler before calling SetErrorHandler again.');
		if (!$strName) {
			// No Error Handling is wanted -- simulate a "On Error, Resume" type of functionality
			set_error_handler('QcodoHandleError', 0);
			QApplicationBase::$intStoredErrorLevel = error_reporting(0);
		} else {
			set_error_handler($strName, $intLevel);
			QApplicationBase::$intStoredErrorLevel = -1;
		}
	}
	
	/**
	 * Restores the temporarily overridden default error handling mechanism back to the default.
	 */
	public static function RestoreErrorHandler() {
		if (is_null(QApplicationBase::$intStoredErrorLevel))
			throw new QCallerException('Error handler is not currently overridden.  Cannot reset something that was never overridden.');
		if (QApplicationBase::$intStoredErrorLevel != -1)
			error_reporting(QApplicationBase::$intStoredErrorLevel);
		restore_error_handler();
		QApplicationBase::$intStoredErrorLevel = null;
	}
	
	/**
	 * @var null
	 */
	private static $intStoredErrorLevel = null;
	
	/**
	 * @param $strPath
	 * @param null $intMode
	 * @return bool
	 */
	public static function MakeDirectory($strPath, $intMode = null) {
		return QFolder::MakeDirectory($strPath, $intMode);
	}
	
	
	/**
	 * This will redirect the user to a new web location.  This can be a relative or absolute web path, or it
	 * can be an entire URL.
	 *
	 * @param string $strLocation target patch
	 * @return void
	 */
	public static function Redirect($strLocation) {
		// Clear the output buffer (if any)
		ob_clean();
		
		if ((QApplication::$RequestMode == QRequestMode::Ajax) ||
			(array_key_exists('Qform__FormCallType', $_POST) &&
				($_POST['Qform__FormCallType'] == QCallType::Ajax))) {
			// AJAX-based Response
			
			// Response is in XML Format
			header('Content-Type: text/xml');
			
			// Output it and update render state
			$strLocation = 'document.location="' . $strLocation . '"';
			$strLocation = QString::XmlEscape($strLocation);
			print('<?xml version="1.0"?><response><controls/><commands><command>' . $strLocation . '</command></commands></response>');
			
		} else {
			// Was "DOCUMENT_ROOT" set?
			if (array_key_exists('DOCUMENT_ROOT', $_SERVER) && ($_SERVER['DOCUMENT_ROOT'])) {
				// If so, we're likley using PHP as a Plugin/Module
				// Use 'header' to redirect
				header(sprintf('Location: %s', $strLocation));
			} else {
				// We're likely using this as a CGI
				// Use JavaScript to redirect
				printf('<script type="text/javascript">document.location = "%s";</script>', $strLocation);
			}
		}
		
		// End the Response Script
		exit();
	}
	
	
	/**
	 * This will close the window.  It will immediately end processing of the rest of the script.
	 *
	 * @return void
	 */
	public static function CloseWindow() {
		// Clear the output buffer (if any)
		ob_clean();
		
		if (QApplication::$RequestMode == QRequestMode::Ajax) {
			// AJAX-based Response
			
			// Response is in XML Format
			header('Content-Type: text/xml');
			
			// OUtput it and update render state
			_p('<?xml version="1.0"?><response><controls/><commands><command>window.close();</command></commands></response>', false);
			
		} else {
			// Use JavaScript to close
			_p('<script type="text/javascript">window.close();</script>', false);
		}
		
		// End the Response Script
		exit();
	}
	
	/**
	 * Gets the value of the QueryString item $strItem.  Will return NULL if it doesn't exist.
	 *
	 * @param string $strItem the parameter name
	 *
	 * @return string value of the parameter
	 */
	public static function QueryString($strItem) {
		if (array_key_exists($strItem, $_GET))
			return $_GET[$strItem];
		else
			return null;
	}
	
	/**
	 * Generates a valid URL Query String based on values in the provided array. If no array is provided, it uses the global $_GET
	 * @param array $arr
	 * @return string
	 */
	public static function GenerateQueryString($arr = null) {
		if(null === $arr)
			$arr = $_GET;
		if (count($arr)) {
			$strToReturn = '';
			foreach ($arr as $strKey => $mixValue)
				$strToReturn .= QApplication::GenerateQueryStringHelper(urlencode($strKey), $mixValue);
			return '?' . substr($strToReturn, 1);
		} else
			return '';
	}
	
	/**
	 * @param $strKey
	 * @param $mixValue
	 * @return null|string
	 */
	protected static function GenerateQueryStringHelper($strKey, $mixValue) {
		if (is_array($mixValue)) {
			$strToReturn = null;
			foreach ($mixValue as $strSubKey => $mixValue) {
				$strToReturn .= QApplication::GenerateQueryStringHelper($strKey . '[' . $strSubKey . ']', $mixValue);
			}
			return $strToReturn;
		} else
			return '&' . $strKey . '=' . urlencode($mixValue);
	}
	
	/**
	 * By default, this is used by the codegen and form drafts to do a quick check
	 * on the ALLOW_REMOTE_ADMIN constant (as defined in configuration.inc.php).  If enabled,
	 * then anyone can access the page.  If disabled, only "localhost" can access the page.
	 * If you want to run a script that should be accessible regardless of
	 * ALLOW_REMOTE_ADMIN, simply remove the CheckRemoteAdmin() method call from that script.
	 * @return
	 */
	public static function CheckRemoteAdmin() {
		if (!QApplication::IsRemoteAdminSession()) {
			return;
		}
		
		// If we're here -- then we're not allowed to access.  Present the Error/Issue.
		if (__ALLOW_REMOTE_ADMIN_VIA_MAINTENANCEPWD__ === true) {
			AppSpecificFunctions::Redirect(__SUBDIRECTORY__.'/RemoteAccess/');
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 401 Access Denied');
			header('Status: 401 Access Denied', true);
			
			throw new QRemoteAdminDeniedException();
		}
	}
	
	
	/**
	 * @param string $attr The attribute you would like to receive
	 * @return string
	 */
	public static function getCurrentAccountAttribute($attr = 'Id') {
		$currentAccount = null;
		if (isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"])) {
			$currentAccount = Account::Load($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"]);
		}
		if (!$currentAccount)
			return 'Anonymous';
		if (strtoupper($attr) == 'ID')
			return $currentAccount->Id;
		if (strtoupper($attr) == 'EMAILADDRESS')
			return $currentAccount->EmailAddress;
		if (strtoupper($attr) == 'FULLNAME')
			return $currentAccount->FullName;
		if (strtoupper($attr) == 'FIRSTNAME')
			return $currentAccount->FirstName;
		if (strtoupper($attr) == 'LASTNAME')
			return $currentAccount->LastName;
		if (strtoupper($attr) == 'USERROLE') {
			if ($currentAccount->UserRoleObject)
				return $currentAccount->UserRoleObject->Role;
		}
		return 'Anonymous';
	}
	
	/**
	 * @return string
	 */
	public static function getCurrentUserEmailForAudit() {
		return AppSpecificFunctions::getCurrentAccountAttribute('EmailAddress');
	}
	
	/**
	 * @return null|string
	 */
	public static function getCurrentUserRole() {
		$CurrentAccount = Account::Load(AppSpecificFunctions::getCurrentAccountAttribute());
		if (!$CurrentAccount)
			return null;
		if (isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_UserRoleId'])) {
			$UserRole = UserRole::Load($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_UserRoleId']);
			if ($UserRole) {
				return $UserRole->Role;
			}
		}
		return null;
	}
	
	/**
	 * @param array $UserRoleArray
	 * @return bool
	 */
	public static function checkPageAccess($UserRoleArray = array()) {
		$currentUserRole = AppSpecificFunctions::getCurrentUserRole();
		if (!$currentUserRole)
			return false;
		foreach ($UserRoleArray as $aRole) {
			if ($currentUserRole == $aRole)
				return true;
		}
		return false;
	}
	
	/**
	 * @param string $str
	 * @return mixed
	 */
	public static function removeSpacesFromString($str = '') {
		return str_replace(' ', '', $str);
	}
	/**
	 * Checks whether the current request was made by an ADMIN
	 * This does not refer to your Database admin or an Admin user defined in your application but an IP address
	 * (or IP address range) defined in configuration.inc.php.
	 *
	 * The function can be used to restrict access to sensitive pages to a list of IPs (or IP ranges), such as the LAN to which
	 * the server hosting the QCubed application is connected.
	 * @static
	 * @return bool
	 */
	public static function IsRemoteAdminSession() {
		// Allow Remote?
		if (ALLOW_REMOTE_ADMIN === true)
			return false;
		
		if (__ALLOW_REMOTE_ADMIN_VIA_MAINTENANCEPWD__ === true) {
			return !QApplicationBase::checkCurrentRemoteAccess();
		}
		
		// Are we localhost?
		if (substr($_SERVER['REMOTE_ADDR'],0,4) == '127.' || $_SERVER['REMOTE_ADDR'] == '::1')
			return false;
		
		// Are we the correct IP?
		if (is_string(ALLOW_REMOTE_ADMIN))
			foreach (explode(',', ALLOW_REMOTE_ADMIN) as $strIpAddress) {
				if (QApplication::IsIPInRange($_SERVER['REMOTE_ADDR'], $strIpAddress) ||
					(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && (QApplication::IsIPInRange($_SERVER['HTTP_X_FORWARDED_FOR'], $strIpAddress)))) {
					return false;
				}
			}
		return true;
	}
	
	/**
	 * @return bool
	 */
	public static function checkCurrentRemoteAccess() {
		$IPAddress = $_SERVER['REMOTE_ADDR'];
		if (!class_exists('RemoteAccess'))
			return false;
		$hasAccess = RemoteAccess::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::RemoteAccess()->IpAddress,$IPAddress),
			QQ::GreaterThan(QQN::RemoteAccess()->AccessDateTime,QDateTime::Now()->AddMinutes(-5))));
		if ($hasAccess)
			return true;
		return false;
	}
	
	/**
	 * Returns the current device type as a string (computer, tablet or phone)
	 * @return string
	 */
	public static function GetDeviceType() {
		$detect = new Mobile_Detect;
		return ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	}
	
	/**
	 * Checks whether the given IP falls into the given IP range
	 * @static
	 * @param string $ip the IP number to check
	 * @param string $range the IP number range. The range could be in 'IP/mask' or 'IP - IP' format. mask could be a simple
	 * integer or a dotted netmask.
	 * @return bool
	 */
	public static function IsIPInRange($ip, $range) {
		$ip = trim($ip);
		if (strpos($range, '/') !== false) {
			// we are given a IP/mask
			list($net, $mask) = explode('/', $range);
			$net = ip2long(trim($net));
			$mask = trim($mask);
			$ip_net = ip2long($net);
			if (strpos($mask, '.') !== false) {
				// mask has the dotted notation
				$ip_mask = ip2long($mask);
			} else {
				// mask is an integer
				$ip_mask = ~((1 << (32 - $mask)) - 1);
			}
			$ip = ip2long($ip);
			return ($net & $ip_mask) == ($ip & $ip_mask);
		}
		if (strpos($range, '-') !== false) {
			// we are given an IP - IP range
			list($first, $last) = explode('-', $range);
			$first = ip2long(trim($first));
			$last = ip2long(trim($last));
			$ip = ip2long($ip);
			return $first <= $ip && $ip <= $last;
		}
		
		// $range is a simple IP
		return $ip == trim($range);
	}
	
	/**
	 * Gets the value of the PathInfo item at index $intIndex.  Will return NULL if it doesn't exist.
	 *
	 * The way PathInfo index is determined is, for example, given a URL '/folder/page.php/id/15/blue',
	 * QApplication::PathInfo(0) will return 'id'
	 * QApplication::PathInfo(1) will return '15'
	 * QApplication::PathInfo(2) will return 'blue'
	 *
	 * @param int $intIndex index
	 * @return string|null
	 */
	public static function PathInfo($intIndex) {
		// TODO: Cache PathInfo
		$strPathInfo = urldecode(QApplication::$PathInfo);
		
		// Remove Starting '/'
		if (QString::FirstCharacter($strPathInfo) == '/')
			$strPathInfo = substr($strPathInfo, 1);
		
		$strPathInfoArray = explode('/', $strPathInfo);
		
		if (array_key_exists($intIndex, $strPathInfoArray))
			return $strPathInfoArray[$intIndex];
		else
			return null;
	}
	
	/**
	 * @var array
	 */
	public static $AlertMessageArray = array();
	/**
	 * @var array
	 */
	public static $JavaScriptArray = array();
	/**
	 * @var array
	 */
	public static $JavaScriptArrayHighPriority = array();
	/**
	 * @var array
	 */
	public static $JavaScriptArrayLowPriority = array();
	
	/**
	 * @var bool
	 */
	public static $ErrorFlag = false;
	
	/**
	 * @param $strMessage
	 */
	public static function DisplayAlert($strMessage) {
		array_push(QApplication::$AlertMessageArray, $strMessage);
	}
	
	/**
	 * Thic class can be used to call a Javascript function sittin in the client browser from the server side.
	 * Can be used inside event handlers to do something after verification  on server side.
	 * @static
	 * @param string $strJavaScript the javascript to execute
	 * @param int $intPriority
	 */
	public static function ExecuteJavaScript($strJavaScript, $intPriority = QJsPriority::Standard) {
		if (is_bool($intPriority)) {
			//we keep this codepath for backward compatibility
			if ($intPriority == true)
				array_push(QApplication::$JavaScriptArrayHighPriority, $strJavaScript);
			else
				array_push(QApplication::$JavaScriptArray, $strJavaScript);
		} else {
			switch ($intPriority) {
				case QJsPriority::High:
					array_push(QApplication::$JavaScriptArrayHighPriority, $strJavaScript);
					break;
				case QJsPriority::Low:
					array_push(QApplication::$JavaScriptArrayLowPriority, $strJavaScript);
					break;
				default:
					array_push(QApplication::$JavaScriptArray, $strJavaScript);
					break;
			}
		}
	}
	
	/**
	 * Can show or hide a bootrstrap modal with a given ID
	 * @param $strModalID
	 * @param bool|false $hide
	 * @param bool|false $show
	 * @param null $elementToFocus
	 */
	public static function ToggleModal($strModalID,$hide = false,$show = false,$elementToFocus = null) {
		$js = "$('#".$strModalID."').modal('toggle');";
		if ($hide)
			$js = "$('#".$strModalID."').modal('hide');";
		elseif ($show)
			$js = "$('#".$strModalID."').modal('show');";
		QApplicationBase::ExecuteJavaScript($js);
		if ($elementToFocus) {
			QApplicationBase::setFocusToElementWithDelay($elementToFocus);
		}
	}
	
	/**
	 * Displays the noted feedback bar at the top of the page
	 * @param string $feedbackMessage
	 * @param bool|true $good
	 * @param bool|true $autoHide
	 * @param int $duration
	 */
	public static function ShowNotedFeedback($feedbackMessage = '',$good = true,$autoHide = true,$duration = 5000,$goodColor = '#3c9a5f',$badColor = '#dd3333',$textColor = '#ffffff',$position = 'top') {
		$goodJS = $good ? 'true':'false';
		$autoHideJS = $autoHide ? 'true':'false';
		$js = 'ShowNotedFeedback(\''.$feedbackMessage.'\','.$goodJS.','.$autoHideJS.','.$duration.',\''.$goodColor.'\',\''.$badColor.'\',\''.$textColor.'\',\''.$position.'\');';
		QApplication::ExecuteJavaScript($js);
	}
	
	/**
	 *Hides the progress bar
	 */
	public static function HideProgressModal() {
		$js = "removeAjaxOverlay();";
		QApplication::ExecuteJavaScript($js);
	}
	
	/**
	 * Returns a hashed password if successful
	 * @param string $PlainTextPassword
	 * @return bool|string
	 */
	public static function getHashedPassword($PlainTextPassword = '') {
		$hashedPassword = password_hash($PlainTextPassword,PASSWORD_BCRYPT);
		return $hashedPassword;
	}
	
	/**
	 * Returns true of the plaintext password matches the hashed password
	 * @param $PlainTextPassword
	 * @param $hashedPassword
	 * @return bool
	 */
	public static function verifyHashedPassword($PlainTextPassword, $hashedPassword) {
		return password_verify($PlainTextPassword,$hashedPassword);
	}
	
	/**
	 * @param $str
	 * @return float
	 */
	public static function GetFloatValue($str) {
		if(strstr($str, ",")) {
			$str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
			$str = str_replace(",", ".", $str); // replace ',' with '.'
		}
		
		if(preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.'
			return floatval($match[0]);
		} else {
			return floatval($str); // take some last chances with floatval
		}
	}
	
	
	/**
	 * Generates a random string with a default length of 200 characters
	 * @param int $length
	 * @return string
	 */
	public static function generateRandomString($length = 200) {
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}
	
	/**
	 * @param string $string
	 * @return mixed Returns a string with all special characters and spaces removed
	 */
	public static function getCleanString($string = '') {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	/**
	 * Useful for modals to ensure focus happens after the modal has loaded. De
	 * @param null $elemId
	 * @param int $delay in ms
	 */
	public static function setFocusToElementWithDelay($elemId = null,$delay = 800) {
		if ($elemId) {
			$js = 'setTimeout(function() {
                    $( "#'.$elemId.'" ).focus();
                }, '.$delay.');';
			QApplicationBase::ExecuteJavaScript($js);
		} else {
			$js = 'console.log("Could not set focus... No element provided.");';
			QApplicationBase::ExecuteJavaScript($js);
		}
	}
	
	/**
	 * Checks for https protocol
	 * @return bool
	 */
	public static function isSecure() {
		return
			(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
			|| $_SERVER['SERVER_PORT'] == 443;
	}
	/**
	 * Checks for www in url protocol
	 * @return bool
	 */
	public static function HostHasWWW() {
		if(preg_match('/^www/', $_SERVER['HTTP_HOST']))
			return true;
		return false;
	}
	
	/**
	 * Returns the current app base url down to __SUBDIRECTORY__
	 * @return string
	 */
	public static function getBaseUrl() {
		$protocol = 'http://';
		if (QApplication::isSecure())
			$protocol = 'https://';
		$www = QApplicationBase::HostHasWWW()?'www.':'';
		$server = $_SERVER['SERVER_NAME'];
		$port = '';
		if (($_SERVER["SERVER_PORT"] != "80") && ($_SERVER["SERVER_PORT"] != "443")) {
			$port = ':'.$_SERVER["SERVER_PORT"];
		}
		$url = $protocol.$www.$server.$port.__SUBDIRECTORY__;
		return $url;
	}
	
	/**
	 * Used to set the after login page when a user needs to login first
	 * @param string $userRole
	 * @param string $page
	 */
	public static function setAfterLoginRedirectPage($userRole = 'Admin',$page = 'index') {
		setcookie(__APPNAME__.'AfterLoginRedirectPage','/App/'.$userRole.'/'.$page,time()+3600,'/');
	}
	
	/**
	 * Used to get the after login page when a user needs to login first
	 * @return string
	 */
	public static function getAfterLoginRedirectPage() {
		if (isset($_COOKIE[__APPNAME__.'AfterLoginRedirectPage'])) {
			return __SUBDIRECTORY__.$_COOKIE[__APPNAME__.'AfterLoginRedirectPage'];
		}
		return __USRMNG__;
	}
	
	/**
	 * Returns the entire app size, including the db as a string
	 * @return string
	 */
	public static function getAppSize() {
		return QApplication::getSizeSymbolByQuantity(QApplication::getFolderSize(__DOCROOT__.__SUBDIRECTORY__)+QApplication::getDatabaseSizeInBytes());
	}
	
	/**
	 * Returns the entire app size, including the db as a float
	 * @return int
	 */
	public static function getAppSizeInBytes() {
		return QApplication::getFolderSize(__DOCROOT__.__SUBDIRECTORY__)+QApplication::getDatabaseSizeInBytes();
	}
	
	/**
	 * Returns the entire app size, excluding the db as a string
	 * @return string
	 */
	public static function getAppStorageUsage() {
		return QApplication::getSizeSymbolByQuantity(QApplication::getFolderSize(__DOCROOT__.__SUBDIRECTORY__));
	}
	
	/**
	 * * Returns the entire app size, excluding the db as an int
	 * @return int
	 */
	public static function getAppStorageUsageInBytes() {
		return QApplication::getFolderSize(__DOCROOT__.__SUBDIRECTORY__);
	}
	
	/**
	 * Provides a symbol based on the size provided
	 * @param $bytes
	 * @return string
	 */
	public static function getSizeSymbolByQuantity($bytes) {
		$symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
		$exp = floor(log($bytes)/log(1024));
		
		return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
	}
	
	/**
	 * Provides the size on disk of the given path
	 * @param $path
	 * @return int
	 */
	public static function getFolderSize($path) {
		$total_size = 0;
		$files = scandir($path);
		$cleanPath = rtrim($path, '/'). '/';
		
		foreach($files as $t) {
			if ($t<>"." && $t<>"..") {
				$currentFile = $cleanPath . $t;
				if (is_dir($currentFile)) {
					$size = QApplication::getFolderSize($currentFile);
					$total_size += $size;
				}
				else {
					$size = filesize($currentFile);
					$total_size += $size;
				}
			}
		}
		
		return $total_size;
	}
	
	/**
	 * Gets the database size as a string
	 * @return string
	 */
	public static function getDatabaseSize() {
		return QApplication::getSizeSymbolByQuantity(QApplication::getDatabaseSizeInBytes());
	}
	
	/**
	 * Gets the database size as an int
	 * @return int
	 */
	public static function getDatabaseSizeInBytes() {
		$dbArray = unserialize(DB_CONNECTION_1);
		$host = $dbArray['server'];
		$username = $dbArray['username'];
		$password = $dbArray['password'];
		$db_name = $dbArray['database'];
		
		$link = mysqli_connect("$host","$username","$password","$db_name")
		or die("Error " . mysqli_error($link));
		mysqli_select_db($link,"$db_name");
		$q = mysqli_query($link,"SHOW TABLE STATUS");
		$size = 0;
		while($row = mysqli_fetch_array($q)) {
			$size += $row["Data_length"] + $row["Index_length"];
		}
		return $size;
	}
	
	/**
	 * Triggers a file download
	 * @param null $fileId
	 * @param bool|false $showInBrowser
	 */
	public static function DownloadFile($fileId = null,$showInBrowser = false) {
		if ($fileId) {
			if (!QApplicationBase::FileHasContents(FileDocument::Load($fileId))) {
				QApplicationBase::ShowNotedFeedback('Could not locate file!',false);
				return;
			}
			$_SESSION['FileDocumentId'] = $fileId;
			if ($showInBrowser)
				$js = 'if (window.navigator.standalone == true) {
					       alert("Cannot download files in standalone mode. Please visit the web app using your browser");
					   } else {
					        var newWin = window.open("'.__SUBDIRECTORY__.'/App/Downloads/DownloadFile.php?showinbrowser=1");
							if(!newWin || newWin.closed || typeof newWin.closed==\'undefined\') {
							    alert("We are trying to open a new tab in order to display the file, but it seems that your browser is currently blocking popups. Please allow popups to continue.");
							}
					   }';
			else
				$js = 'if (window.navigator.standalone == true) {
					       alert("Cannot download files in standalone mode. Please visit the web app using your browser");
					   } else {
					        var newWin = window.open("'.__SUBDIRECTORY__.'/App/Downloads/DownloadFile.html");
							if(!newWin || newWin.closed || typeof newWin.closed==\'undefined\') {
							    alert("We are trying to open a new tab in order to download the file, but it seems that your browser is currently blocking popups. Please allow popups to continue.");
							}
					   }';
			QApplication::ExecuteJavaScript($js);
		} else {
			QApplicationBase::ShowNotedFeedback('Could not locate file!',false);
		}
	}
	
	/**
	 * This functions attempts to display a generated PDF file as an embedded object. It assumes the standard generated PDF folder.
	 * @param null $fileId. The Id of the FileDocument object
	 */
	public static function ViewGeneratedPDF($fileId = null) {
		if (AppSpecificFunctions::GetDeviceType() != 'computer') {
			AppSpecificFunctions::DownloadFile($fileId,true);
			return;
		}
		if ($fileId) {
			$FileDocument = FileDocument::Load($fileId);
			if (!AppSpecificFunctions::FileHasContents($FileDocument)) {
				AppSpecificFunctions::ShowNotedFeedback('Could not locate file!',false);
				return;
			}
			$filePathCorrected = $FileDocument->Path;
			if (file_exists(__DOCROOT__.$FileDocument->Path))
				$filePathCorrected = __DOCROOT__.$FileDocument->Path;
			$ftype = 'application/octet-stream';
			$fres = AppSpecificFunctions::checkMSExtensions($filePathCorrected);
			if (is_string($fres) && !empty($fres)) {
				$ftype = $fres;
			}
			$EmbedPath = AppSpecificFunctions::getBaseUrl().'/sDevFunctions/GeneratedPDFs/'.$FileDocument->FileName;
			$_SESSION['FileDocumentId'] = $fileId;
			$js = 'var DownloadFileWrapper_zIndex = getHighestZIndex()+1;
						$("#DownloadFileWrapper").remove();
						var DownloadFileWrapperHeight = getHeightValueForPercentage(98);
						var DownloadFileWrapperMargin = Math.round(($( window ).width()*0.1)/2);
						var EmbedWidth = Math.round($(window).width()*0.9);
						var EmbedHeight = DownloadFileWrapperHeight-50;
					    $("body").append(\'<div id="DownloadFileWrapper" style="z-index:\'+DownloadFileWrapper_zIndex+\'; width:90%;height:\'+DownloadFileWrapperHeight+\'px; margin-left:\'+DownloadFileWrapperMargin+\'px;"><div style="height:50px;width:100%;background-color: #fff;padding:10px;"><span style="font-size: 18px;">View File</span><button id="CloseDownloadButton" type="button" class="close">x</button></div><object data="'.$EmbedPath.'" type="'.$ftype.'" title="Download" width="\'+EmbedWidth+\'" height="\'+EmbedHeight+\'"><div style="padding:15px;"><a href="'.__SUBDIRECTORY__.'/App/Downloads/DownloadFile.html" target="_blank">File cannot be viewed here. Click to download</a></div></object></div>\');
					    $("#CloseDownloadButton").on("click", function() {$("#DownloadFileWrapper").remove();});';
			AppSpecificFunctions::ExecuteJavaScript($js);
			return;
		} else {
			AppSpecificFunctions::ShowNotedFeedback('Could not locate file!',false);
		}
	}
	
	/**
	 * This function attempts to return the file type
	 * @param $file. The correct file path (Could be from either DocRoot or not)
	 * @return bool|string
	 */
	public static function checkMSExtensions($file) {
		$arrayZips = array("application/zip", "application/x-zip", "application/x-zip-compressed");
		$arrayExtensions = array(".pptx", ".docx", ".dotx", ".xlsx");
		$original_extension = (false === $pos = strrpos($file, '.')) ? '' : substr($file, $pos);
		$finfo = new finfo(FILEINFO_MIME);
		$type = $finfo->file($file);
		if (in_array($type, $arrayZips) && in_array($original_extension, $arrayExtensions)) {
			return $original_extension;
		}
		return $type;
	}
	
	/**
	 * @param string $tableData
	 * @param string $fileName without extension
	 * @return bool
	 */
	public static function ExportToCSV($tableData = '',$fileName = 'exported_csv_file') {
		if (strlen($tableData) < 1){
			QApplicationBase::ShowNotedFeedback('Could not export to CSV... Not data provided',false);
			return false;
		}
		if (QApplicationBase::GetDeviceType() != 'computer') {
			QApplicationBase::ShowNotedFeedback('Export only supported on desktop devices',false);
			return false;
		}
		$_SESSION['TableToExport'] = urlencode($tableData);
		if (strlen($fileName) > 0)
			$_SESSION['CSVFilename'] = urlencode($fileName);
		$js = 'if (window.navigator.standalone == true) {
						alert("Cannot download files in standalone mode. Please visit the web app using your browser");
						} else
							window.open("'.__SUBDIRECTORY__.'/App/Downloads/DownloadCSVFile.html");';
		QApplication::ExecuteJavaScript($js);
		return true;
	}
	
	/**
	 * @param string $tableData
	 * @param string $filePostFix
	 * @param string $Delimiter. Typically use ";" when exporting specifically for excel and ',' otherwise
	 * @param bool $WrapFirstColumn, If this is false, the first column is not wrapped in "" to allow for importing with other php scripts
	 * @param bool $ExportHeaders
	 * @param bool $DeleteAfterDownload. By default this is true. Please consider that this creates a security risk when set to false;
	 * @return bool|string
	 */
	public static function createCSVFileForDownload($tableData = '', $filePostFix = '', $Delimiter = ',', $WrapFirstColumn = false, $ExportHeaders = false, $DeleteAfterDownload = true) {
		if (strlen($tableData) < 1){
			AppSpecificFunctions::ShowNotedFeedback('Could not export to CSV... Not data provided',false);
			return false;
		}
		if (AppSpecificFunctions::GetDeviceType() != 'computer') {
			AppSpecificFunctions::ShowNotedFeedback('Export only supported on desktop devices',false);
			return false;
		}
		$fileName = QDateTime::Now()->format('Ymd_His').'_'.$filePostFix.'_1.csv';
		$count = 2;
		while (file_exists(__DOCROOT__.__SUBDIRECTORY__."/App/Downloads/CSVExportForDownload/".$fileName)) {
			$fileName = QDateTime::Now()->format('Ymd_His').'_'.$filePostFix.'_'.$count.'.csv';
			$count++;
		}
		
		$html = str_get_html($tableData);
		
		$data = '';
		// Get the rows
		foreach($html->find('tr') as $element) {
			$firstTD = true;
			$headersFound = false;
			foreach( $element->find('th') as $row) {
				if ($ExportHeaders) {
					$plainText = trim($row->plaintext);
					$plainText = str_replace("\r"," ",$plainText);
					$plainText = str_replace("\n"," ",$plainText);
					if (!$WrapFirstColumn) {
						if (!$firstTD)
							$data .= '"'.$plainText.'"'.$Delimiter.'';
						else {
							$data .= $plainText.$Delimiter;
							$firstTD = false;
						}
					} else {
						$data .= '"'.$plainText.'"'.$Delimiter.'';
					}
				}
				$headersFound = true;
			}
			foreach( $element->find('td') as $row) {
				$plainText = trim($row->plaintext);
				$plainText = str_replace("\r"," ",$plainText);
				$plainText = str_replace("\n"," ",$plainText);
				if (!$WrapFirstColumn) {
					if (!$firstTD)
						$data .= '"'.$plainText.'"'.$Delimiter.'';
					else {
						$data .= $plainText.$Delimiter;
						$firstTD = false;
					}
				} else {
					$data .= '"'.$plainText.'"'.$Delimiter.'';
				}
			}
			if (!$ExportHeaders) {
				if ($headersFound) {
					$data = '';
				} else {
					$data = substr($data,0,strlen($data)-1);
					$data .= "\r\n";
				}
			} else {
				$data = substr($data,0,strlen($data)-1);
				$data .= "\r\n";
			}
		}
		
		file_put_contents(__DOCROOT__.__SUBDIRECTORY__."/App/Downloads/CSVExportForDownload/".$fileName,$data);
		$js = '$.post("'.AppSpecificFunctions::getBaseUrl().'/App/Downloads/CSVExportForDownload/cleanupCsvExport.php?f='.urlencode($fileName).'&d=10", function(data, status){
					//alert("Data: " + data + "\nStatus: " + status);
				});';
		AppSpecificFunctions::ExecuteJavaScript($js);
		return $fileName;
	}
	
	
	/**
	 * @param FileDocument $fileDocument
	 * @return bool True if the file exists
	 */
	public static function FileHasContents(FileDocument $fileDocument) {
		if ($fileDocument) {
			if (file_exists(__DOCROOT__.$fileDocument->Path))
				return true;
			if (file_exists($fileDocument->Path))
				return true;
		}
		return false;
	}
	/**
	 * @param $text
	 * @return mixed Returns the value from the text area with breaks as html
	 */
	public static function TextAreaToHtml($text) {
		return str_replace(array("\r\n", "\r", "\n"),'<br />',$text);
	}
	
	/**
	 * @param $html
	 * @return mixed Returns the html value with line breaks for a textarea
	 */
	public static function HtmlToTextArea($html) {
		$initialReplace = str_replace('<br />',"\r\n",$html);
		$secondReplace = str_replace('<br>',"\r\n",$initialReplace);
		$thirdReplace = str_replace('<p>',"",$secondReplace);
		$fourthReplace = str_replace('</p>',"\r\n",$thirdReplace);
		return $fourthReplace;
	}
	
	/**
	 * @param string $InputString
	 * @param string $SplitChar
	 * @return mixed|string
	 */
	public static function getCamelCaseSplitted($InputString = '', $SplitChar = ' ') {
		$Result = trim(preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]|[0-9]{1,}/', ' $0', $InputString));
		$FinalResult = '';
		if (($SplitChar != ' ') && (strlen($Result) > 0)){
			$Words = explode(' ',$Result);
			foreach ($Words as $Word) {
				$FinalResult .= $Word.$SplitChar;
			}
		} else {
			return $Result;
		}
		
		if (strlen($FinalResult) > 0)
			return substr($FinalResult,0,strlen($FinalResult)-strlen($SplitChar));
		return $FinalResult;
	}
	/**
	 * @return array
	 */
	public static function getWorldCountriesAsArray() {
		return array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica",
			"Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain",
			"Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina",
			"Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso",
			"Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile",
			"China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the",
			"Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti",
			"Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia",
			"Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana",
			"French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece",
			"Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands",
			"Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)",
			"Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of",
			"Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia",
			"Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of",
			"Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius",
			"Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco",
			"Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand",
			"Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau",
			"Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion",
			"Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",
			"San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)",
			"Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena",
			"St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic",
			"Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago",
			"Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom",
			"United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)",
			"Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
	}
	/**
	 * @param QTextBox|null $field
	 * @return bool
	 */
	public static function validateFieldAsRequired(QTextBox $field = null) {
		if (!$field)
			return false;
		AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(\''.$field->getJqControlId().'\')');
		if (strlen(trim($field->Text)) < 1) {
			AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$field->getJqControlId().'\',\'Required\')');
			return false;
		}
		return true;
	}
	
	/**
	 * @param QTextBox|null $field
	 * @return bool
	 */
	public static function validateFieldAsNumber(QTextBox $field = null) {
		if (!$field)
			return false;
		AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(\''.$field->getJqControlId().'\')');
		if (!is_numeric($field->Text)) {
			AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$field->getJqControlId().'\',\'Invalid Number\')');
			return false;
		}
		return true;
	}
	
	/**
	 * @param QTextBox|null $field
	 * @param int $min
	 * @param int $max
	 * @return bool
	 */
	public static function validateFieldAsNumberInRange(QTextBox $field = null, $min = 0, $max = 1) {
		if (!$field)
			return false;
		AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(\''.$field->getJqControlId().'\')');
		if (!is_numeric($field->Text)) {
			AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$field->getJqControlId().'\',\'Invalid Number\')');
			return false;
		} else {
			if ($field->Text < $min) {
				AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$field->getJqControlId().'\',\'Must be more than '.$min.'\')');
				return false;
			}
			if ($field->Text > $max) {
				AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$field->getJqControlId().'\',\'Must be less than '.$max.'\')');
				return false;
			}
		}
		return true;
	}
	
	/**
	 * @param QTextBox|null $field
	 * @return bool
	 */
	public static function validateFieldAsEmailAddress(QTextBox $field = null) {
		if (!$field)
			return false;
		AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(\''.$field->getJqControlId().'\')');
		if (!preg_match("/^[_a-z0-9-A-Z]+(\.[_a-z0-9-A-Z]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/", $field->Text)) {
			AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$field->getJqControlId().'\',\'Invalid Email\')');
			return false;
		}
		return true;
	}
	
	/**
	 * @param QTextBox|null $field
	 * @param string $txtInput
	 * @param string $message
	 * @return bool
	 */
	public static function validateFieldAgainstInput(QTextBox $field = null, $txtInput = '', $message = 'Does not match') {
		if (!$field)
			return false;
		AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(\''.$field->getJqControlId().'\')');
		if ($field->Text != $txtInput) {
			AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$field->getJqControlId().'\',\''.$message.'\')');
			return false;
		}
		return true;
	}
	
	/**
	 * The javascript used to initialise the JQuery UI Datepicker
	 * @param string $DatePickerClass
	 * @return string
	 */
	public static function GetDatePickerInitJs($DatePickerClass = 'input-date') {
		$js = '$(\'.'.$DatePickerClass.'\').datepicker({
						showButtonPanel: true,
						dateFormat: "'.DATE_TIME_FORMAT_JS.'",
						changeMonth: true,
						changeYear: true,
						yearRange: "1900:2200"
					});';
		return $js;
	}
	
	/**
	 * This function simply returns the iframe html that enables us to load another QForm inside our current QForm with the option of sending an object Id
	 * @static
	 * @param string $TemplateUrl the location of the template.
	 */
	public static function getTemplateContent($TemplateObjectType = null,$objectId = '',$bottomPadding = 0) {
		$html = '';
		$url = QApplication::getBaseUrl().'/sDevORM/Implementations/'.$TemplateObjectType.'/FormTemplates/'.$TemplateObjectType.'_Template.php/'.$objectId;
		if (QApplication::isValidUrl($url))
			$html = '<iframe onload="resizeIframe(this,'.$bottomPadding.')" src="'.$url.'" style="width:100%;border:none;"></iframe>';
		return $html;
	}
	
	/**
	 * Checks if a url is valid
	 * @param $url
	 * @return bool
	 */
	public static function isValidUrl($url) {
		if ($url) {
			if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Used to post back to the current form using qc.PA
	 * @param null $formId
	 * @param null $actionId
	 * @param string $strParameter
	 * @param string $event
	 * @param bool|true $blnShowProgressBar
	 */
	public static function PostBack($formId = null,$actionId = null,$strParameter = '',$event = 'QClickEvent',$blnShowProgressBar = true) {
		$js = QApplication::getPostBackJs($formId,$actionId,$strParameter,$event,$blnShowProgressBar);
		QApplication::ExecuteJavaScript($js,QJsPriority::High);
	}
	/**
	 * This function returns the js that will to an AJAX postback to the current form
	 * @static
	 * @param string $formId The current form Id
	 * @param string $actionId The JQControlId of the control
	 * @param string $strParameter The the return parameter
	 * @param string $event The event type that occurred
	 * @param string $blnShowProgressBar True to display a progress bar while waiting for Ajax return
	 */
	public static function getPostBackJs($formId = null,$actionId = null,$strParameter = '',$event = 'QClickEvent',$blnShowProgressBar = true) {
		$js = 'qc.pA(\''.$formId.'\',\''.$actionId.'\', \''.$event.'\', \''.$strParameter.'\');';
		if ($blnShowProgressBar)
			$js = 'showAjaxOverlay();qc.pA(\''.$formId.'\',\''.$actionId.'\', \''.$event.'\', \''.$strParameter.'\');';
		return $js;
	}
	
	/**
	 * This function posts to a url using curl and returns the content of the url
	 * @param $url
	 * @param $fields_string provided as variable=value&variable=value
	 * @param string $client
	 * @return mixed
	 */
	public static function PostToUrl($url,$fields_string = '',$client = __APPNAME__) {
		if (!QApplicationBase::isValidUrl($url))
			return '';
		$options = array(
			CURLOPT_RETURNTRANSFER => true,   // return web page
			CURLOPT_HEADER         => false,  // don't return headers
			CURLOPT_FOLLOWLOCATION => true,   // follow redirects
			CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
			CURLOPT_ENCODING       => __QAPPLICATION_ENCODING_TYPE__,     // handle compressed
			CURLOPT_USERAGENT      => $client, // name of client
			CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
			CURLOPT_TIMEOUT        => 120,    // time-out on response
			CURLOPT_POSTFIELDS     => $fields_string,
		);
		
		$ch = curl_init($url);
		curl_setopt_array($ch, $options);
		
		$content  = curl_exec($ch);
		
		curl_close($ch);
		
		return $content;
	}
	
	
	/**
	 * This function sends a file to a location on an ftp server
	 * @param $ftpUrl
	 * @param string $ftpUser
	 * @param string $ftpPassword
	 * @param string $fileRealPath -> Path of the file to send
	 * @param string $fileName -> Name of the file on the server
	 * @return bool
	 */
	public static function sendFile($ftpUrl, $ftpUser = '', $ftpPassword = '', $fileRealPath = '', $fileName = '') {
		/*if (!QApplicationBase::isValidUrl($ftpUrl))
			return false;*/
		try {
			$ftp_conn = ftp_connect($ftpUrl);
			if (false === $ftp_conn) {
				throw new Exception('Unable to connect');
			}
			
			$login = ftp_login($ftp_conn, $ftpUser, $ftpPassword);
			if (true === $login) {
				// Do nothing
			} else {
				ftp_close($ftp_conn);
				throw new Exception('Unable to log in');
			}
			
			// upload file
			if (strlen($fileName) < 1)
				$fileName = QDateTime::Now()->format('dMYHis').'file';
			
			if (ftp_put($ftp_conn, $fileName, $fileRealPath, FTP_BINARY)) {
				// close connection
				ftp_close($ftp_conn);
				return true;
			}
		} catch (Exception $e) {
			// close connection
			AppSpecificFunctions::AddCustomLog("FTP Failure: " . $e->getMessage());
			return false;
		}
		
		
	}
	
	/**
	 * @param $operation sDev API's will have their own methods defined. But each API will at least have the following: CREATE, READ, UPDATE, DELETE
	 * @param $url
	 * @param bool $data The data to either CREATE or UPDATE. Or when READ or DELETE, the id's to read or delete
	 * @param string $username
	 * @param string $password
	 * @return mixed
	 */
	public static function CallsDevAPI($operation = 'CREATE', $url = null, $data = '', $username = '', $password = '') {
		if (!QApplicationBase::isValidUrl($url))
			return '';
		$curl = curl_init();
		if ($data)
			$dataToPost = array_merge(array("OPERATION" => $operation),$data);
		else
			$dataToPost = array("OPERATION" => $operation);
		$options = array(
			CURLOPT_RETURNTRANSFER => true,   // return web page
			CURLOPT_HEADER         => false,  // don't return headers
			CURLOPT_FOLLOWLOCATION => true,   // follow redirects
			CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
			CURLOPT_ENCODING       => __QAPPLICATION_ENCODING_TYPE__,     // handle compressed
			CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
			CURLOPT_TIMEOUT        => 120,    // time-out on response
			CURLOPT_POSTFIELDS     => http_build_query($dataToPost),
			CURLOPT_POST			=> true,
			CURLOPT_HTTPAUTH		=> CURLAUTH_BASIC,
			CURLOPT_USERPWD			=> "$username:$password",
			CURLOPT_URL				=> $url,
			CURLOPT_SSL_VERIFYPEER  => false,
		);
		curl_setopt_array($curl, $options);
		$result = curl_exec($curl);
		
		curl_close($curl);
		
		return $result;
	}
	
	/**
	 * Returns the path to the cropped PNG file
	 * @param $inputFilePath
	 * @param $inputFilename
	 * @param int $thumb_width
	 * @param int $thumb_height
	 * @return string
	 */
	public static function getCroppedPNG($inputFilePath,$inputFilename,$thumb_width=1024,$thumb_height=768) {
		$saveFileName = substr($inputFilename,0,strpos($inputFilename,'.'));
		$input_image = __DOCROOT__.$inputFilePath.$inputFilename;
		
		list($width, $height, $image_type) = getimagesize($input_image);
		$canvas = imagecreatetruecolor( $thumb_width, $thumb_height );
		
		if ($image_type == IMAGETYPE_JPEG)
			$cropped = imagecreatefromjpeg( $input_image );
		elseif ($image_type == IMAGETYPE_PNG)
			$cropped = imagecreatefrompng( $input_image );
		else
			return '-1';
		
		$source_aspect_ratio = $width / $height;
		$desired_aspect_ratio = $thumb_width / $thumb_height;
		
		if ($source_aspect_ratio > $desired_aspect_ratio) {
			/*
			 * Triggered when source image is wider
			 */
			$temp_height = $thumb_width;
			$temp_width = ( int ) ($thumb_height * $source_aspect_ratio);
		} else {
			/*
			 * Triggered otherwise (i.e. source image is similar or taller)
			 */
			$temp_width = $thumb_width;
			$temp_height = ( int ) ($thumb_width / $source_aspect_ratio);
		}
		
		$temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
		imagecopyresampled(
			$temp_gdim,
			$cropped,
			0, 0,
			0, 0,
			$temp_width, $temp_height,
			$width, $height
		);
		
		/*
		 * Copy cropped region from temporary image into the desired GD image
		 */
		
		$x0 = ($temp_width - $thumb_width) / 2;
		$y0 = ($temp_height - $thumb_height) / 2;
		$desired_gdim = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopy(
			$desired_gdim,
			$temp_gdim,
			0, 0,
			$x0, $y0,
			$thumb_width, $thumb_height
		);
		imagepng( $desired_gdim,__DOCROOT__.__SUBDIRECTORY__."/App/uploaded/".$saveFileName.".png");
		
		imagedestroy( $canvas );
		imagedestroy( $cropped );
		imagedestroy( $temp_gdim );
		imagedestroy( $desired_gdim );
		return $inputFilePath.$saveFileName.'.png';
	}
	
	/*Background processes*/
	/**
	 * @param null $ScriptPath: The path to the script that will execute the background process. Needs to be from __DOCROOT__. Implementation of this script needs to follow the example of the script found in "/App/Automation/ExampleBackgroundScript.php"
	 * @param null $PostData: The data to post to the script if any
	 * @param null $UserId: Optional. Can be the Id of the current user or for modular systems, the id of the current individual
	 * @return null|string: If the return is "NULL" this means that something went wrong and has been logged. Else, the PId of the new background process is returned.
	 */
	public static function executeBackgroundProcess($ScriptPath = null, $PostData = null, $UserId = null) {
		if (is_null($ScriptPath))
			return null;
		$PossiblePId = AppSpecificFunctions::generateRandomString(48);
		$Done = false;
		$AttemptCount = 0;
		while (!$Done) {
			$ExistingProcess = BackgroundProcess::QueryCount(QQ::Equal(QQN::BackgroundProcess()->PId,$PossiblePId));
			if ($ExistingProcess == 0) {
				$Done = true;
			}
			$PossiblePId = AppSpecificFunctions::generateRandomString(48);
			$AttemptCount++;
			if ($AttemptCount > 50) {
				AppSpecificFunctions::AddCustomLog('Error while trying to start background process: Could not generate unique PId');
				return null;
			}
		}
		$newBackgroundProcess = new BackgroundProcess();
		$newBackgroundProcess->Status = 'Pending';
		$newBackgroundProcess->PId = $PossiblePId;
		$newBackgroundProcess->StartDateTime = QDateTime::Now();
		$newBackgroundProcess->UpdateDateTime = QDateTime::Now();
		if ($UserId) {
			$newBackgroundProcess->UserId = $UserId;
		} else
			$newBackgroundProcess->UserId = AppSpecificFunctions::getCurrentAccountAttribute();
		try {
			$newBackgroundProcess->Save();
		} catch (QCallerException $e) {
			AppSpecificFunctions::AddCustomLog('Error while trying to start background process: '.$e->getMessage());
			return null;
		}
		if ($PostData)
			$dataToPost = array_merge(array("SystemPassword" => __MAINTENANCEPWD__, "PId" => $newBackgroundProcess->PId),$PostData);
		else
			$dataToPost = array("SystemPassword" => __MAINTENANCEPWD__, "PId" => $newBackgroundProcess->PId);
		$phpPath = AppSpecificFunctions::getPHPExecutableFromPath();
		if ($phpPath !==  false) {
			$ArgsPath = '';
			foreach ($dataToPost as $key=>$val) {
				$ArgsPath .= ' '.$key.'='.$val;
			}
			$Command = $phpPath.' '.$ScriptPath.' '.$ArgsPath.' 2>/dev/null >/dev/null &';
			$Result = shell_exec($Command);
		} else {
			$newBackgroundProcess->Delete();
			return null;
		}
		
		return $newBackgroundProcess->PId;
	}
	
	/**
	 * @return bool|string
	 */
	public static function getPHPExecutableFromPath() {
		if (defined('__SYSTEM_PHP_PATH__'))
			return __SYSTEM_PHP_PATH__;
		
		// Attempt to find the path (This might not work on all servers because of access restrictions
		$paths = explode(PATH_SEPARATOR, getenv('PATH'));
		foreach ($paths as $path) {
			// we need this for XAMPP (Windows)
			if (strstr($path, 'php.exe') && isset($_SERVER["WINDIR"]) && file_exists($path) && is_file($path)) {
				return $path;
			}
			else {
				$php_executable = $path . DIRECTORY_SEPARATOR . "php" . (isset($_SERVER["WINDIR"]) ? ".exe" : "");
				if (file_exists($php_executable) && is_file($php_executable)) {
					return $php_executable;
				}
			}
		}
		return FALSE; // not found
	}
	/**
	 * @param null $PId: The PId of the background process that needs to be updated
	 * @param string $UpdateMessage: A message that is saved for this update
	 * @param string $Status: The status to be set for the background process
	 * @param string $Summary: The summary to be set for the background process
	 * @return bool: True if all is good, false if something went wrong. Logs should then be updated
	 */
	public static function updateBackgroundProcess($PId = null, $UpdateMessage = 'No message provided', $Status = 'Running',$Summary = '') {
		if (!$PId)
			return false;
		$TheProcess = BackgroundProcess::QuerySingle(QQ::Equal(QQN::BackgroundProcess()->PId,$PId));
		if (!$TheProcess)
			return false;
		$TheProcess->Status = $Status;
		$TheProcess->UpdateDateTime = QDateTime::Now();
		$TheProcess->Summary = $Summary;
		try {
			$TheProcess->Save(false,true);
		} catch (QCallerException $e) {
			AppSpecificFunctions::AddCustomLog('Error while trying to update background process with PId '.$PId.': '.$e->getMessage());
			return false;
		}
		$NewProgressUpdate = new BackgroundProcessUpdate();
		$NewProgressUpdate->BackgroundProcessObject = $TheProcess;
		$NewProgressUpdate->UpdateDateTime = QDateTime::Now();
		$NewProgressUpdate->UpdateMessage = $UpdateMessage;
		try {
			$NewProgressUpdate->Save(false,true);
		} catch (QCallerException $e) {
			AppSpecificFunctions::AddCustomLog('Error while trying to update background process with PId '.$PId.'. Could not save the update instance: '.$e->getMessage());
			return false;
		}
		return true;
	}
	
	/**
	 * @param $strBuffer
	 * @return string
	 */
	public static function OutputPage($strBuffer) {
		// If the ProcessOutput flag is set to false, simply return the buffer
		// without processing anything.
		if (!QApplication::$ProcessOutput)
			return $strBuffer;
		
		if (QApplication::$ErrorFlag) {
			return $strBuffer;
		} else {
			if (QApplication::$RequestMode == QRequestMode::Ajax) {
				return trim($strBuffer);
			} else {
				// Update Cache-Control setting
				header('Cache-Control: ' . QApplication::$CacheControl);
				
				$strScript = QApplicationBase::RenderJavaScript(false);
				
				if ($strScript)
					return sprintf('%s<script type="text/javascript">%s</script>', $strBuffer, $strScript);
				
				return $strBuffer;
			}
		}
	}
	
	/**
	 * Function renders Javascript on the client browser.
	 * @static
	 * @param bool $blnOutput if true print the result, otherwise return it
	 * @return null|string
	 */
	public static function RenderJavaScript($blnOutput = true) {
		$strScript = '';
		foreach (QApplication::$AlertMessageArray as $strAlert) {
			$strAlert = addslashes($strAlert);
			$strScript .= sprintf('alert("%s"); ', $strAlert);
		}
		foreach (QApplication::$JavaScriptArrayHighPriority as $strJavaScript) {
			$strJavaScript = trim($strJavaScript);
			if (QString::LastCharacter($strJavaScript) != ';')
				$strScript .= sprintf('%s; ', $strJavaScript);
			else
				$strScript .= sprintf('%s ', $strJavaScript);
		}
		foreach (QApplication::$JavaScriptArray as $strJavaScript) {
			$strJavaScript = trim($strJavaScript);
			if (QString::LastCharacter($strJavaScript) != ';')
				$strScript .= sprintf('%s; ', $strJavaScript);
			else
				$strScript .= sprintf('%s ', $strJavaScript);
		}
		foreach (QApplication::$JavaScriptArrayLowPriority as $strJavaScript) {
			$strJavaScript = trim($strJavaScript);
			if (QString::LastCharacter($strJavaScript) != ';')
				$strScript .= sprintf('%s; ', $strJavaScript);
			else
				$strScript .= sprintf('%s ', $strJavaScript);
		}
		
		QApplication::$AlertMessageArray = array();
		QApplication::$JavaScriptArrayHighPriority = array();
		QApplication::$JavaScriptArray = array();
		QApplication::$JavaScriptArrayLowPriority = array();
		
		if ($strScript) {
			if ($blnOutput) {
				_p($strScript, false);
			} else {
				return $strScript;
			}
		}
		return null;
	}
	
	/**
	 * If LanguageCode is specified and QI18n::Initialize() has been called, then this
	 * will perform a translation of the given token for the specified Language Code and optional
	 * Country code.
	 *
	 * Otherwise, this will simply return the token as is.
	 * This method is also used by the global print-translated "_t" function.
	 *
	 * @param string $strToken
	 * @return string the Translated token (if applicable)
	 */
	public static function Translate($strToken) {
		if (QApplication::$LanguageObject)
			return QApplication::$LanguageObject->TranslateToken($strToken);
		else
			return $strToken;
	}
	
	/**
	 * Global/Central HtmlEntities command to perform the PHP equivalent of htmlentities.
	 * Feel free to override to specify encoding/quoting specific preferences (e.g. ENT_QUOTES/ENT_NOQUOTES, etc.)
	 *
	 * This method is also used by the global print "_p" function.
	 *
	 * @param string $strText text string to perform html escaping
	 * @return string the html escaped string
	 */
	public static function HtmlEntities($strText) {
		return htmlentities($strText, ENT_COMPAT, QApplication::$EncodingType);
	}
	
	/**
	 * For development purposes, this static method outputs all the Application static variables
	 *
	 * @return void
	 */
	public static function VarDump() {
		_p('<div class="var-dump"><strong>Core Settings</strong><ul>', false);
		$arrValidationErrors = QInstallationValidator::Validate();
		foreach ($arrValidationErrors as $objResult) {
			printf('<li><strong class="warning">WARNING:</strong> %s</li>', $objResult->strMessage);
		}
		$data = array("APIKEY" => SDEV_LICENSE);
		$ReadResult = AppSpecificFunctions::CallsDevAPI('GETLATESTVERSION','https://distribution.stratusolvecloud.com/API/Object/sDevVersion.php/',$data,'u','p');
		$LatestVersion = 'Could not be retrieved (<i>Ensure that your license key is valid</i>)';
		$resultArray = json_decode($ReadResult);
		if ($resultArray) {
			if ($resultArray->Result == 'Success') {
				$LatestVersion = $resultArray->Version;
			}
		}
		
		
		//printf('<li>QCUBED_VERSION = "%s"</li>', QCUBED_VERSION);
		printf('<li>App Name = "%s"</li>', __APPNAME__);
		printf('<li>Server Instance = "%s"</li>', SERVER_INSTANCE);
		if ($LatestVersion == __SDEVBASE_VERSION__)
			printf('<li>sDev Version = "%s"</li><li>Latest sDev Version = "%s"</li>', __SDEVBASE_VERSION__,$LatestVersion);
		else
			printf('<li>sDev Version = "%s"</li><li style="color:red;">Latest sDev Version = <a href="'.__PHP_ASSETS__.'/_devtools/Update.php">"%s"</a></li>', __SDEVBASE_VERSION__,$LatestVersion);
		printf('<li>sDev License Key = "%s"</li>', SDEV_LICENSE);
		printf('<li>jQuery version = "%s"</li>', __JQUERY_CORE_VERSION__);
		printf('<li>jQuery UI version = "%s"</li>', __JQUERY_UI_VERSION__);
		printf('<li>__SUBDIRECTORY__ = "%s"</li>', __SUBDIRECTORY__);
		printf('<li>__VIRTUAL_DIRECTORY__ = "%s"</li>', __VIRTUAL_DIRECTORY__);
		printf('<li>__INCLUDES__ = "%s"</li>', __INCLUDES__);
		printf('<li>__QCUBED_CORE__ = "%s"</li>', __QCUBED_CORE__);
		printf('<li>ERROR_PAGE_PATH = "%s"</li>', ERROR_PAGE_PATH);
		printf('<li>PHP Include Path = "%s"</li>', get_include_path());
		printf('<li>QApplication::$DocumentRoot = "%s"</li>', QApplication::$DocumentRoot);
		printf('<li>QApplication::$ServerAddress = "%s"</li>', QApplication::$ServerAddress);
		
		if (QApplication::$Database) foreach (QApplication::$Database as $intKey => $objObject) {
			printf('<li>QApplication::$Database[%s] settings:</li>', $intKey);
			_p("<ul>", false);
			foreach (unserialize(constant('DB_CONNECTION_' . $intKey)) as $key => $value) {
				if ($key == "password") {
					$value = "hidden for security purposes";
				}
				
				_p("<li>" . $key. " = " . var_export($value, true). "</li>", false);
			}
			_p("</ul>", false);
			
		}
		_p('</ul></div>', false);
	}
	
	/**
	 * Override this method with the location to your app's logo
	 * @return string
	 */
	public static function getAppLogoUrl() {
		return __APP_IMAGE_ASSETS__.'/StratuSolve_logo_blue.png';
	}
	/**
	 * This function updates the developer log which is viewable from the right hand side of the app when DEV_MODE is enabled
	 * @param string $Content
	 */
	public static function AddCustomLog($Content = '') {
		$currentLog = file_get_contents(__DOCROOT__.__SUBDIRECTORY__.'/assets/_core/php/DeveloperMode/CustomLog.txt');
		$currentDateTime = QDateTime::Now()->format(DATE_TIME_FORMAT_HTML.' H:i:s');
		$microTime = substr((string)microtime(), 1, 8);
		$newContent = $currentLog.'<strong>'.$currentDateTime.$microTime.' -> </strong>'.$Content.'<br>';
		file_put_contents(__DOCROOT__.__SUBDIRECTORY__.'/assets/_core/php/DeveloperMode/CustomLog.txt',$newContent);
		$js = 'updateDeveloperLog();';
		QApplicationBase::ExecuteJavaScript($js);
	}
	
	// UI Specific function helpers
	/**
	 * Returns a new button with an action attached to it. The action still needs to be implemented by the developer
	 * @param QForm $parentForm
	 * @param string $btnText
	 * @param string $cssClass
	 * @param string $MethodName
	 * @param bool|false $mustConfirm
	 * @param string $ConfirmText
	 * @return QButton
	 * @throws QCallerException
	 */
	public static function getNewActionButton(QForm $parentForm,$btnText = 'Button',$cssClass = 'btn btn-default',$MethodName = 'NewAction',$mustConfirm = false,$ConfirmText = 'Are you sure?',$ShowOverlay = true) {
		$btn = new QButton($parentForm);
		$btn->Text = $btnText;
		$btn->CssClass = $cssClass;
		if ($mustConfirm)
			$btn->AddAction(new QClickEvent(), new QConfirmAction($ConfirmText));
		$btn->AddAction(new QClickEvent(), new QAjaxAction($MethodName,null,null,null,null,$ShowOverlay));
		return $btn;
	}
	
}

/**
 * Class for enumerating Javascript priority.
 */
class QJsPriority {
	/**
	 *
	 */
	const Standard = 0;
	/**
	 *
	 */
	const High = 1;
	/**
	 *
	 */
	const Low = -1;
}

/**
 * This is an enumerator class for listing Request Modes
 */
class QRequestMode {
	/**
	 *
	 */
	const Standard = 'Standard';
	/**
	 *
	 */
	const Ajax = 'Ajax';
}

/**
 * Class QBrowserType
 */
class QBrowserType {
	/**
	 *
	 */
	const InternetExplorer = 1;
	/**
	 *
	 */
	const InternetExplorer_6_0 = 2;
	/**
	 *
	 */
	const InternetExplorer_7_0 = 4;
	
	/**
	 *
	 */
	const InternetExplorer_8_0 = 8;
	
	/**
	 *
	 */
	const Firefox = 16;
	/**
	 *
	 */
	const Firefox_1_0 = 32;
	/**
	 *
	 */
	const Firefox_1_5 = 64;
	/**
	 *
	 */
	const Firefox_2_0 = 128;
	/**
	 *
	 */
	const Firefox_3_0 = 256;
	
	/**
	 *
	 */
	const Safari = 512;
	/**
	 *
	 */
	const Safari_2_0 = 1024;
	/**
	 *
	 */
	const Safari_3_0 = 2048;
	/**
	 *
	 */
	const Safari_4_0 = 4096;
	
	/**
	 *
	 */
	const Opera = 8192;
	/**
	 *
	 */
	const Opera_7 = 16384;
	/**
	 *
	 */
	const Opera_8 = 32768;
	/**
	 *
	 */
	const Opera_9 = 65536;
	
	/**
	 *
	 */
	const Konqueror = 131072;
	/**
	 *
	 */
	const Konqueror_3 = 262144;
	/**
	 *
	 */
	const Konqueror_4 = 524288;
	
	/**
	 *
	 */
	const Chrome = 1048576;
	/**
	 *
	 */
	const Chrome_0 = 2097152;
	/**
	 *
	 */
	const Chrome_1 = 4194304;
	
	/**
	 *
	 */
	const Windows = 8388608;
	/**
	 *
	 */
	const Linux = 16777216;
	/**
	 *
	 */
	const Macintosh = 33554432;
	
	/**
	 *
	 */
	const Unsupported = 67108864;
}
?>
