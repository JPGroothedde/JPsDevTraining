<?php
/*
 * Copyright (C) 2016 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 */

	require(__DOCROOT__.__SUBDIRECTORY__.'/Licensing/ChecksDevLicense.php');
    require(__SDEV_ORM__ . '/sDev_CodeGenerator/_core/sDev_CodeGeneratorBase.class.php');

	class sDev_CodeGenerator extends sDev_CodeGeneratorBase {
		protected function Pluralize($strName) {
			// Special Rules go Here
			switch (true) {
				case ($strName == 'person'):
					return 'people';
				case ($strName == 'Person'):
					return 'People';
				case ($strName == 'PERSON'):
					return 'PEOPLE';

				// Trying to be cute here...
				case (strtolower($strName) == 'fish'):
					return $strName . 'ies';

				// Otherwise, call parent
				default:
					return parent::Pluralize($strName);
			}
		}
	}

	require(__SDEV_ORM__ . '/sDev_CodeGenerator/_core/library.inc.php');
?>