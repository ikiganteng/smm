<?php

 
	function curl($url, $params, $cookie, $header, $httpheaders = array(), $request = 'POST', $socks = null)
	{
		$ch = curl_init();
			
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
 
		if($cookie == true)
		{	
			$cookFile = tempnam('/tmp','cookie.txt');
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookFile);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookFile);
		}
 
		curl_setopt($ch, CURLOPT_HEADER, $header);
		@curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheaders);
 
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		curl_setopt($ch, CURLOPT_PROXY, $socks);
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
 
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
 
	function getStr($page, $str1, $str2, $line_str2, $line)
	{
		$get = explode($str1, $page);
		$get2 = explode($str2, $get[$line_str2]);
		return $get2[$line];
	}
 
	function randStr($type, $length)	
	{
		$characters = array();
		$characters['angka'] = '0123456789';
		$characters['kapital'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters['huruf'] = 'abcdefghijklmnopqrstuvwxyz';
		$characters['kapital_angka'] = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters['huruf_angka'] = '0123456789abcdefghijklmnopqrstuvwxyz';
		$characters['all'] = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters[$type]);
		$randomString = '';
 
		for ($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[$type][rand(0, $charactersLength - 1)];
		}
 
		return $randomString;
 
	}   
 
 
	function fetchCookies($source) 
	{
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $source, $matches);
		$cookies = array();
		foreach($matches[1] as $item) 
 
		{
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}
 
		return $cookies;
	}
	
 $url = "https://appnana2.mapiz.com/api/nanaer_login/";
		$postdata = "email=ikiganteng%40gegsulbar.com&password=123456&source=Android.google-play&signkey=".md5(rand(0000000000, 999999999999)).md5(rand(0000000000000, 99999999999999))."&android_id=".rand(00000000, 9999999999)."&version=3.5.10&gaid=3cc83187-89ae-492f-ab53-".rand(0000000000, 9999999999)."&gaid_enabled=true";
		$__cfduid = "__cfduid=".md5(rand(000000, 999999999)).md5(rand(000000000, 999999999));
 
		$headers = array();
		$headers[] = "Accept: application/json; version=1.2";
		$headers[] = "User-Agent: com.appnana.android.giftcardrewards/3.5.10 ".rand(00000000000, 9999999999).md5(rand(0000000000, 99999999999));
		$headers[] = "Accept-Language: en-US";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Host: appnana2.mapiz.com";
		$headers[] = "Connection: close";
		$headers[] = "Cookie: ".$__cfduid;
		$headers[] = "Cookie2: \$Version=1";
 
		$login = curl($url, $postdata, false, true, $headers);
		if(strpos($login, '"errstr":"SUCCESS"') == true)
		{
			@$getCookies = fetchCookies($login);
			@$csrftoken = "csrftoken=".$getCookies['csrftoken'];
			@$sessionid = "sessionid=".$getCookies['sessionid'];
 
			$urls = "https://appnana2.mapiz.com/api/get_nanaer_info/?email=".str_replace("@", "%40", '4amfams@gmail.com');
			$post = null;
 
			$head = array();
			$head[] = "Accept: application/json; version=1.2";
			$head[] = "Accept-Language: en-US";
			$head[] = "Host: appnana2.mapiz.com";
			$head[] = "Cookie: ".$__cfduid."; ".$csrftoken."; ".$sessionid;
			$head[] = "Cookie2: \$Version=1";
 
			$getInfo = curl($urls, $post, false, false, $head, 'GET');	
 
			@$accountId = getStr($getInfo, '"id":', ',', 1, 0);
			@$deviceId = getStr($getInfo, '"device_id":', '}', 1, 0);
 
			if(!empty($csrftoken) or !empty($sessionid) or !empty($accountId) or !empty($deviceId))
			{
				$urls = "https://ads30.adcolony.com/configure";
				$post = '{"advertiser_id":"","carrier":"","custom_id":"'.$accountId."z".$deviceId.'","screen_height":1024,"screen_width":576,"limit_tracking":false,"ln":"en","locale":"US","device_brand":"xia2322323","device_model":"aawawaw","device_type":"tablet","media_path":"/data/data/com.appnana.android.giftcardrewards/files/adc3/media/","temp_storage_path":"/data/data/com.appnana.android.giftcardrewards/files/adc3/tmp/","network_type":"wifi","os_name":"android","os_version":"5.1.1","sdk_version":"3.3.5","sdk_type":"android_native","current_orientation":0,"battery_level":1,"timezone_ietf":"Asia/Shanghai","timezone_gmt_m":480,"timezone_dst_m":0,"cell_service_country_code":"id","android_id_sha1":"","device_api":22,"memory_used_mb":23,"memory_class":192,"available_stores":["google"],"permissions":["android.permission.INTERNET","android.permission.READ_EXTERNAL_STORAGE","android.permission.WRITE_EXTERNAL_STORAGE","android.permission.READ_PHONE_STATE","android.permission.ACCESS_NETWORK_STATE","android.permission.ACCESS_WIFI_STATE","android.permission.WAKE_LOCK"],"immersion":false,"display_dpi":191,"origin_store":"google","user_id":"'.$accountId."z".$deviceId.'","app_id":"appf859456ab93d4f1d8d90e3","zones":["vz57d827b000b64b8191daac"],"ad_history":{"":[]},"ad_playing":{"":[]},"ad_queue":{},"sid":"9467c89f-d6ef-434a-8435-8d648b49523e","s_imp_count":0,"device_time":1557026236698,"controller_version":"1.0.9.33","user_metadata":{},"ad_request":true,"device_audio":true,"zone_ids":[""],"force_ad_id":"","test_mode":false,"guid":"","guid_key":""}';
 
				$head = array();
				$head[] = "Accept-Charset: UTF-8";
				$head[] = "Content-Type: application/json";
				$head[] = "User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.1.1; aawawaw Build/LMY48Z)";
				$head[] = "Host: ads30.adcolony.com";
 
				$getPL = curl($urls, $post, false, false, $head);
				$PL = getStr($getPL, 'start":"{s0}/t/5.0/start?pl=', '"', 1, 0);
				if(!empty($PL))
				{
					$fh = fopen("4am.txt", "a");
		fwrite($fh, $__cfduid."; ".$csrftoken."; ".$sessionid."||".$PL."||".$email);
		fclose($fh);  
					print "success! Silahkan lanjut ngebot";
				}else{
					print  "<pre>".$getPL." PL ngga ada broo..<br><a href='https://web.facebook.com/yaelahhwil' target='_blank'>Contact </a>";
				}
			}else{
				print "Ada yang Tidak Beres broo!..<br><a href='https://web.facebook.com/yaelahhwil' target='_blank'>Contact </a>";
			}
		}else{
			print "<pre>".$login;
		}
 ?>
