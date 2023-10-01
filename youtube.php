<?php

    /* 
        Ali: https://github.com/azrov 
    */

    $id   = (isset($_GET['id']) ? $_GET['id'] : '');
	$url  = 'https://www.youtube.com/watch?v=' . $id;
	$post = array(
			'link'  => $url,
			'from' => 'videodownloaded'
		);

	$ch  = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.ytbvideoly.com/api/thirdvideo/parse');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; Tizen 2.3; SmartHub; SMART-TV; SmartTV; U; Maple2012) AppleWebKit/538.1+ (KHTML, like Gecko) TV Safari/538.1+');
	curl_setopt($ch, CURLOPT_REFERER, 'https://ytbvideoly.com/');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);

	curl_close($ch);

	$json   = json_decode($response, true);
	$videos = $json['data']['videos']['mp4'];
	$url    = $videos[1]['url'];
	
	header("Location: " . $url);
	
?>
