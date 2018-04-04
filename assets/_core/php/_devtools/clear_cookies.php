<?php
	require_once('../sdev.inc.php');
	AppSpecificFunctions::CheckRemoteAdmin();

	$strPageTitle = 'sDev Framework - Start Page';
	require(__CONFIGURATION__ . '/header.inc.php');
?>
<div class="row jumbotron">
    <h2 class="page-header">Cookies Cleared!</h2>
    <?php
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }

    ?>

    <ol class="link-list">
        <li><a href="<?php _p(__VIRTUAL_DIRECTORY__ . __DEVTOOLS__) ?>/start_page.php">Go Back</a></li>
    </ol>

</div>
<?php require(__CONFIGURATION__ . '/footer.inc.php'); ?>