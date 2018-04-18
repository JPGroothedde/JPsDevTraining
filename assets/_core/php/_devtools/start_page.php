<?php
	require_once('../sdev.inc.php');
	AppSpecificFunctions::CheckRemoteAdmin();
	
	// Create an installation status message.
	$arrInstallationMessages = QInstallationValidator::Validate();
	$strConfigStatus = ($arrInstallationMessages) ?
		'<div class=" alert alert-warning">Current installation status: <br>' . count($arrInstallationMessages).' problem(s) found. <a href="' . __VIRTUAL_DIRECTORY__ . __DEVTOOLS__ . '/config_checker.php">Click here</a> to view details.</div>' :
		'<div class="alert alert-success">Current installation status: all OK.</div>';
	
	$strPageTitle = 'sDev Framework - Start Page';
    require (__CONFIGURATION__.'/HeaderComponents/standard_header_init.inc.php');
?>
<style>
    body {
        padding-top:0px;
    }
</style>
<div class="container-fluid">
    <h1 class="page-header">Welcome to the sDev Framework!</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-info" role="alert">If you are seeing this, the framework is up and running.</div>
            <h3 class="page-header">App Management</h3>
            <div class="list-group">
                <a href="<?php _p(__VIRTUAL_DIRECTORY__ . __DBMNG__)?>/ManageDatabase.php" class="list-group-item rippleclick">
                    <h4 class="list-group-item-heading">Synchronise Database</h4>
                    <p class="list-group-item-text">Based on the data model defined in class DataModel<br><small>WINDOWS USERS: Ensure that your database is set to be CASE SENSITIVE</small></p>
                </a>
                <a href="<?php _p(__VIRTUAL_SDEV_ORM__) ?>/index.php" class="list-group-item rippleclick">
                    <h4 class="list-group-item-heading">ORM Generator</h4>
                    <p class="list-group-item-text">Create the sDev ORM, controllers and templates that allow complex front-end interaction</p>
                </a>
                <a href="<?php _p(__SUBDIRECTORY__.'/assets/bootstrap-sass') ?>/index.php" class="list-group-item rippleclick">
                    <h4 class="list-group-item-heading">Bootstrap Generator</h4>
                    <p class="list-group-item-text">Generate the bootstrap css from the SASS variables defined in /bootstrap-sass/vx.xx/assets/stylesheets/bootstrap/_variables.scss</p>
                </a>
                <a href="<?php _p(__VIRTUAL_DIRECTORY__ . __USRMNG__) ?>/setupInitialUser.php" class="list-group-item rippleclick">
                    <h4 class="list-group-item-heading">Create an Admin Account</h4>
                    <p class="list-group-item-text">The Admin account allows you to log into the app and manage other users.</p>
                </a>
                <a href="<?php _p(__VIRTUAL_DIRECTORY__ . __DEVTOOLS__) ?>/clear_cookies.php" class="list-group-item rippleclick">
                    <h4 class="list-group-item-heading">Clear Cookies</h4>
                    <p class="list-group-item-text">Sometimes useful when debugging an app</p>
                </a>
                <a href="<?php _p(__VIRTUAL_DIRECTORY__ . __DEVTOOLS__) ?>/ViewLogs.php" class="list-group-item rippleclick">
                    <h4 class="list-group-item-heading">Error Logs</h4>
                    <p class="list-group-item-text">View system generated and custom error logs</p>
                </a>
                <a href="<?php _p(__SUBDIRECTORY__.'/App/') ?>" class="list-group-item rippleclick">
                    <h4 class="list-group-item-heading">View App</h4>
                    <p class="list-group-item-text">Redirects to the App homepage</p>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <?php _p($strConfigStatus, false) ?>
            <pre><code><?php QApplication::VarDump(); ?></code></pre>
        </div>
    </div>
    <?php require(__CONFIGURATION__ . '/footer.inc.php'); ?>
</div>


