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

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$curl = curl_init();
$PId = -1;
$BaseUrl = '';
if (isset($_GET['pid']))
	$PId = $_GET['pid'];
if (isset($_GET['bp_url']))
	$BaseUrl = $_GET['bp_url'];
$dataToPost = array("PId" => $PId);
$url = $BaseUrl.'/SSE_Implementation.php';
$options = array(
	CURLOPT_RETURNTRANSFER => true,   // return web page
	CURLOPT_HEADER         => false,  // don't return headers
	CURLOPT_FOLLOWLOCATION => true,   // follow redirects
	CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
	CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
	CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
	CURLOPT_TIMEOUT        => 120,    // time-out on response
	CURLOPT_POSTFIELDS     => http_build_query($dataToPost),
	CURLOPT_POST			=> true,
	CURLOPT_URL				=> $url,
	CURLOPT_SSL_VERIFYPEER  => false,
);
curl_setopt_array($curl, $options);
$result = curl_exec($curl);
curl_close($curl);
if ($result) {
	if (strpos($result,'COMPLETED') !== false)
		sendMsg('COMPLETED',$PId);
	else
		sendMsg('NOT DONE',$PId);
} else {
	sendMsg('UNKNOWN',$PId);
}
function sendMsg($Msg,$PId) {
	//echo "id: $PId\n";
	echo "data: {\n";
	echo "data: \"msg\": \"$Msg\", \n";
	echo "data: \"id\": \"$PId\"\n";
	echo "data: }\n\n";
}

?>