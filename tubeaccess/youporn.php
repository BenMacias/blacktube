<?php
	$searchqry = $_GET['searchqry'];
	$thePage = $_GET['page'];
	$cat = $_GET['category_id'];
	$curl_connection = curl_init();
	$yp_categories = array(
                                '1' => 'amateur',
                                '2' => 'anal',
                                '3' => 'asian',
                                '4' => 'bbw',
                                '6' => 'big-butt',
                                '7' => 'big-tits',
                                '5' => 'bisexual',
                                '51' => 'blonde',
                                '9' => 'blowjob',
                                '52' => 'brunette',
                                '10' => 'coed',
                                '11' => 'compilation',
                                '12' => 'couples',
                                '13' => 'creampie',
                                '37' => 'cumshots',
                                '15' => 'cunnilingus',
                                '16' => 'dp',
                                '44' => 'dildos-Toys',
                                '8' => 'ebony',
                                '48' => 'european',
                                '17' => 'facial',
                                '42' => 'fantasy',
                                '18' => 'fetish',
                                '62' => 'fingering',
                                '19' => 'funny',
                                '20' => 'gay',
                                '58' => 'german',
                                '50' => 'gonzo',
                                '21' => 'group-sex',
                                '65' => 'hd',
                                '46' => 'hairy',
                                '22' => 'handjob',
                                '23' => 'hentai',
                                '24' => 'instructional',
                                '25' => 'interracial',
                                '41' => 'interview',
                                '40' => 'kissing',
                                '49' => 'latina',
                                '26' => 'lesbian',
                                '29' => 'milf',
								'64' => 'massage',
								'55' => 'masturbate',
								'28' => 'mature',
								'36' => 'pov',
								'56' => 'panties',
								'57' => 'pantyhose',
								'30' => 'public',
								'53' => 'redhead',
								'43' => 'rimming',
								'61' => 'romantic',
								'54' => 'shaved',
								'31' => 'shemale',
								'60' => 'solo-male',
								'27' => 'solo-girl',
								'39' => 'squirting',
								'47' => 'straight-sex',
								'59' => 'swallow',
								'32' => 'teen',
								'38' => 'threesome',
								'33' => 'vintage',
								'34' => 'voyeur',
								'35' => 'webcam',
								'45' => 'young-old',
								'63' => '3d'
								);
						   
	if(empty($searchqry) && empty($cat))
	{
		$url = "http://www.youporn.com/?page=".$thePage;
	}elseif(empty($searchqry) && !empty($cat)){
		$url = "http://www.youporn.com/category/".$cat."/".$yp_categories[$cat]."/?page=".$thePage;
	}else{
		$url = "http://www.youporn.com/search/?query=".$searchqry."&page=".$thePage."&category_id=".$cat;
	}
	curl_setopt($curl_connection, CURLOPT_URL, $url);
	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl_connection, CURLOPT_COOKIE, 'age_verified=1');
	curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl_connection, CURLOPT_HEADER, false);
	curl_setopt($curl_connection, CURLOPT_REFERER, "http://www.youporn.com/");
	$result = curl_exec($curl_connection);
	htmlentities($result);
	echo $result;
?>
