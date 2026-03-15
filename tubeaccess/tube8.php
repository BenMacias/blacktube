<?php
	$searchqry = $_GET['searchqry'];
	$searchqry = str_replace('-','+',$searchqry);
	$thePage = $_GET['page'];
	if($thePage==0 or empty($thePage)){
		$thePage = 1;
	}
	$cat = $_GET['category_id'];
	$curl_connection = curl_init();
	$yp_categories = array(
                                '13' => 'anal',
								'12' => 'asian',
								'7' => 'blowjob',
								'4' => 'ebony',
								'11' => 'erotic',
								'5' => 'fetish',
								'1' => 'hardcore',
								'22' => 'hd',
								'21' => 'indian',
								'14' => 'latina',
								'8' => 'lesbian',
								'2' => 'mature',
								'10' => 'strip',
								'3' => 'teen'
								);
	if(empty($searchqry) && empty($cat)){
		$url = "http://www.tube8.com/latest/page/".$thePage;
	}elseif(empty($searchqry) && !empty($cat)){
		$url = "http://www.tube8.com/searches.html?q=".$yp_categories[$cat]."&page=".$thePage;
	}elseif(!empty($searchqry) && empty($cat)){
		$url = "http://www.tube8.com/searches.html?q=".$searchqry."&page=".$thePage;
	}else{
		$url = "http://www.tube8.com/searches.html?q=".$searchqry."+".$yp_categories[$cat]."&page=".$thePage;
	}
	curl_setopt($curl_connection, CURLOPT_URL, $url);
	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt ($curl_connection, CURLOPT_COOKIEFILE, 'cookies.txt');
	curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl_connection, CURLOPT_HEADER, true);
	curl_setopt($curl_connection, CURLOPT_REFERER, "http://www.tube8.com/");
	$result = curl_exec($curl_connection);
	$result = substr( $result, 0, strpos( $result, '<span id="copyright">' ) );
	echo $result;
?>
