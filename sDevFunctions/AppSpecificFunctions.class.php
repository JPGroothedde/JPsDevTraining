<?php
	/**
	 * This abstract class should never be instantiated.  It contains static methods,
	 * variables and constants to be used throughout the application.
	 *
	 * The static method "Initialize" should be called at the begin of the script by
	 * prepend.inc.
	 */
	abstract class AppSpecificFunctions extends QApplicationBase {
		// Define public static functions here...
		/**
		 * Override this method with the location to your app's logo
		 * @return string
         */
		public static function getAppLogoUrl() {
			return __APP_IMAGE_ASSETS__.'/StratuSolve_logo_blue.png';
		}
	}
?>
