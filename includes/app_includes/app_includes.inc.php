<?php
	/*
	 * =============================================
	 * AVAILING YOUR CUSTOM CLASSES FOR AUTOLOADING
	 * =============================================
	 * This file is run everytime the framework initializes
	 * (i.e. on each page access or in anyfile where you include prepend.inc.php or qcubed.inc.php)
	 *
	 * This file is intended to allow you AutoLoading your own classes along with the the core framework classes.
	 *
	 * For example:
	 * QApplicationBase::$ClassFile['plantypes'] = __APP_INCLUDES__ . '/classes/PlanTypes.class.php';
	 * QApplicationBase::$ClassFile['planlayout'] = __APP_INCLUDES__ . '/controls/PlanLayout.class.php';
	 *
	 * Note that the format is:
	 * QApplicationBase::$ClassFile['classname'] = __APP_INCLUDES__ .'/path/to/file_containing_the_class/FileName.class.php';
	 *
	 * The class you define in the '/path/to/file_containing_the_class/FileName.class.php' file can be in
	 * any case but the same classname must be written in all lower case in the QApplicationBase::$ClassFile['classname']
	 * as the key name to the QApplicationBase::$ClassFile array.
	 * If that is not done, your class will not be available for autoloading.
	 *
	 * -------
	 * NOTE:
	 * The directories 'classes' and 'controls' or any other directories must be created by you.
	 * They do not come by default.
	 * -------
	 *
	 * In case you want to run some custom code on each page access (such as counting number of hits etc),
	 * you should create a new file for that and include it here. Do not put executable PHP code here directly.
	 *
	 * You may add the file as:
	 *
	 * require_once(__APP_INCLUDES__ . '/functions/blog_functions.inc.php');
	 *
	 * ===============================
	 * MODIFYING QCUBED CORE FILES
	 * ===============================
	 *
	 * This file is intended to be used to override most core files.
	 * For example, if you want to override the QControlBase class then you should do the following:
	 * -------------
	 * 1. Copy the QControlBase.class.php file and paste it somewhere in the __APP_INCLUDES__ directory
	 *    (i.e the directory where this file is located)
	 *    Let us say you paste it in 'core_overrides' directory under __APP_INCLUDES__.
	 *
	 * 2. Make your desired modifications in the newly pasted file and save it.
	 *
	 * 3. Add the line
	 *      QApplicationBase::$ClassFile['qcontrolbase'] = __APP_INCLUDES__ .'/core_overrides/QControlBase.class.php';
	 *    to this file (app_includes.inc.php) at the bottom
	 *
	 * 4. Save this file (app_includes.inc.php).
	 * --------------
	 * This way you would not have to modify the real core files and in case you do an upgrade of the framework
	 * by over-writing it, then you will be retaining all your old changes.
	 *
	 * Do note that when you do an overwrite upgrade of the framework, this file too gets overwritten. To make sure
	 * that you do not lose your changes when upgrading, please do either of the following:
	 *
	 * 1. Make a separate backup of this file before doing the upgrade. After upgrade, copy back the contents of
	 *      the old file into the new file.
	 *
	 * 2. Put all the contents you plan to into another file (say my_includes.inc.php) and include that file here
	 *      by doing a "require_once 'my_includes.inc.php';". This will make sure that an overwrite upgrade does
	 *      cause much trouble (all you would need to do is to add one line).
	 * ================ [END] ================
         */
?>

<?php
require_once(__DOCROOT__.__SUBDIRECTORY__.'/DatabaseManagement/DataModel.class.php');
require_once(__SDEV_FUNCTIONS__ . '/AppSpecificFunctions.class.php');
require_once(__SDEV_FUNCTIONS__ . '/AppMenus.class.php');
require_once(__PHPMailer__.'/PHPMailerAutoload.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/simpleHTML.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsBase.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsTabs.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsPanelCollapse.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsVideoPlayer.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsModal.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsIFrame.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsCheckableControlGroup.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsSortableAccordion.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsProgressBar.php');
require_once(__SIMPLE_ENHANCEMENTS__.'/sUIElementsCalendar.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sDataGrid.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sDataList.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sStaticTable.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sFileUploader.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sQRCode.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sImageCropper.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sCSVImporter.php');
require_once(__SDEV_CONTROLS__.'/BaseControls/sEntitySelectModal.php');
require_once(__DOCROOT__ .__USRMNG__.'/checkRole.php');
require_once(__DOCROOT__ .__USRMNG__.'/currentAccount.php');
require_once(__CONFIGURATION__.'/Mobile_Detect.php');
require_once(__SDEV_FUNCTIONS__.'/sEmailMessage.php');
require_once(__SDEV_FUNCTIONS__ . '/sEncryptDecrypt.php');
require_once(__SDEV_FUNCTIONS__ . '/sHtml2PdfInstance.php');
require_once(__SDEV_FUNCTIONS__ . '/sChartInstance.php');
require_once(__SDEV_FUNCTIONS__ . '/sCSVImport.php');
include_once(__DOCROOT__.__APP_PHP_ASSETS__.'/simple_html_dom.php');
?>
