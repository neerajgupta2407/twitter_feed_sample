<?php

$a = "curl --get 'https://stream.twitter.com/1.1/statuses/filter.json' --data 'track=twitter' --header 'Authorization: OAuth oauth_consumer_key=\"ET6U0YxbmWrhierxw6kwA\", oauth_nonce=\"fd0e2843c253c091b93d69fef783400c\", oauth_signature=\"0YPoywMoXj6zL1jNWtlF7jc4rvU%3D\", oauth_signature_method=\"HMAC-SHA1\", oauth_timestamp=\"1432289846\", oauth_token=\"322518002-wfqVNQ527yfbrHTVdsY7Mg3BKjwqCPTTAm96ieZP\", oauth_version=\"1.0\"' --verbose";



//exec($a);


$url = 'https://stream.twitter.com/1.1/statuses/filter.json';
$s = curl_init(); 
//$header_arr1 = $header_arr['Authorization'] = array();
$header_arr['OAuth oauth_consumer_key'] = 'ET6U0YxbmWrhierxw6kwA';
$header_arr['oauth_nonce'] = '6a1d8ad85d434034d363adbb949940ba';
$header_arr['oauth_signature'] = 'AsjpBCLhF%2FS5ghBBazho5qaiLXk%3D';
$header_arr['oauth_signature_method'] = 'HMAC-SHA1';
$header_arr['oauth_timestamp'] = '1432291940';
$header_arr['oauth_token'] = '322518002-wfqVNQ527yfbrHTVdsY7Mg3BKjwqCPTTAm96ieZP';
$header_arr['oauth_version'] = '1.0';



curl_setopt($s,CURLOPT_URL,$url); 
curl_setopt($s,CURLOPT_HTTPHEADER,array('Expect:')); 
curl_setopt($s, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($s, CURLOPT_POST, 0);

curl_setopt($s, CURLOPT_HTTPHEADER, $header_arr);

	
$http_result = curl_exec($s);   //http_result will be json_encoded...hence we need to decode it and will return it as array.
$error = curl_error($s);
$http_code = curl_getinfo($s ,CURLINFO_HTTP_CODE);

curl_close($s);  //closing the curl request..

echo  json_decode($http_result,true);
