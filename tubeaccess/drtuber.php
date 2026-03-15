<?php
	$searchqry = $_GET['searchqry'];
	$thePage = $_GET['page'];
	if($thePage<1){
		$thePage=1;
	}
	$cat = $_GET['category_id'];
	$curl_connection = curl_init();
	if(empty($searchqry) && empty($cat) && $thePage==1){
		$url = "https://www.drtuber.com/";
	}elseif(empty($searchqry) && empty($cat)){
		$url = "https://www.drtuber.com/videos/".$thePage;
	}elseif(empty($searchqry) && !empty($cat)){
		if($thePage==1){
			$url = "https://www.drtuber.com/".$cat;
		}else{
			$url = "https://www.drtuber.com/".$cat."/".$thePage;
		}
	}else{
		if($thePage==1){
			$url = "https://www.drtuber.com/search/videos/".$searchqry;
		}else{
			$url = "https://www.drtuber.com/search/videos/".$searchqry."/".$thePage;
		}
	}
	curl_setopt($curl_connection, CURLOPT_URL, $url);
	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt ($curl_connection, CURLOPT_COOKIEFILE, 'cookies.txt');
	curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl_connection, CURLOPT_HEADER, false);
	curl_setopt($curl_connection, CURLOPT_REFERER, "https://www.drtuber.com/");
	$result = curl_exec($curl_connection);
	echo $result;
?>
