<?php
function api_call($opt_array){
	$curl =  curl_init();
	$opt_array = $opt_array;

	curl_setopt_array($curl, $opt_array);
	$resp = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	curl_close($curl);
	return [$status, $resp];
}
?>