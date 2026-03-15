<?php
	$searchqry = $_GET['searchqry'];
	$thePage = $_GET['page'];
	$cat = $_GET['category_id'];
	$curl_connection = curl_init();
	if(empty($searchqry) && empty($cat)){
		$url = "http://www.pornhub.com/video?page=".$thePage;
	}elseif(empty($searchqry) && !empty($cat)){
		$url = "http://www.pornhub.com/video?c=".$cat."&page=".$thePage;
	}elseif(empty($cat)){
		$url = "http://www.pornhub.com/video/search?search=".$searchqry."&page=".$thePage;
	}else{
		$url = "http://www.pornhub.com/video/search?search=".$searchqry."&filter_category=".$cat."&page=".$thePage;
	}
	curl_setopt($curl_connection, CURLOPT_URL, $url);
	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl_connection, CURLOPT_COOKIEFILE, 'cookies.txt');
	curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl_connection, CURLOPT_HEADER, true);
	curl_setopt($curl_connection, CURLOPT_REFERER, "http://www.pornhub.com/");
	$result = curl_exec($curl_connection);
	echo $result;
?>
