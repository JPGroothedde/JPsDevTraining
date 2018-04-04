<?php
/*
 To Download files, simply call the DownloadFile.html script
 To View files, call this script directly with the paramater "showinbrowser" set
 */
require('../../sdev.inc.php');
if (isset($_SESSION['FileDocumentId'])) {
	$FileDocument = FileDocument::Load($_SESSION['FileDocumentId']);
	unset($_SESSION['FileDocumentId']);
}
else
	die("No file found!");
$download = true;
if (isset($_GET['showinbrowser'])) {
	$download = false;
	unset($_GET['showinbrowser']);
}
if ( getCurrentAccount() ) {
	$file = $FileDocument->Path;
	$filePathCorrected = $file;
	if (file_exists(__DOCROOT__.$file))
		$filePathCorrected = __DOCROOT__.$file;
	
	$ftype = 'application/octet-stream';
	$fres = AppSpecificFunctions::checkMSExtensions($filePathCorrected);
	if (is_string($fres) && !empty($fres)) {
		$ftype = $fres;
	}
	if (strpos($ftype,'image') !== false) {
		$type = pathinfo($filePathCorrected, PATHINFO_EXTENSION);
		$data = file_get_contents($filePathCorrected);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		echo '<img src="'.$base64.'" />';
	} else {
		header('Content-type: '.$ftype.'');
		if ($download)
			header('Content-Disposition: attachment; filename="'.$FileDocument->FileName.'"');
		else {
			header('Content-Disposition: inline; filename="'.$FileDocument->FileName.'"');
			header('Accept-Ranges: bytes');
		}
		readfile($filePathCorrected);
	}
} else {
	die("You do not have the rights to download this file");
}

?>

