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
$configPath = "includes/configuration";

if (!defined ('__PREPEND_INCLUDED__')) {	// not already included some other way (like with .htaccess file)
	if (isset($__CONFIG_ONLY__) && $__CONFIG_ONLY__ == true) {
		require_once($configPath . '/configuration.inc.php');
	} else {
		require_once($configPath . '/prepend.inc.php');
	}
}
?>