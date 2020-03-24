<?php 
	session_start();
	if(isset($_GET['id']) && isset($_GET['date'])){
		$_SESSION['ID'] = $_GET['id'];
		$_SESSION['password'] = $_GET['date'];
	}else{
		echo "fail";
	}
	require_once("simple_html_dom.php"); 	 
	error_reporting(0);
    ini_set('display_errors', 0);
    
	function get($url,$cookieFile, $referer, $params=array()) {	
		$url = $url.'?'.http_build_query($params, '', '&');    
		$ch = curl_init();    
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);    
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		//curl_setOpt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array('Host: 61.7.235.44'));
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); 
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		$response = curl_exec($ch);    
		curl_close($ch);    
		return $response;
	}
 
	function post($url,$cookieFile, $referer, $fields){
		$post_field_string = http_build_query($fields, '', '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);    
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setOpt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array('Origin: http://61.7.235.44', 'Host: 61.7.235.44'));
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); 
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			
		// for POST method	
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);    
		curl_setopt($ch, CURLOPT_POST, true);    

		$response = curl_exec($ch);    
		curl_close ($ch);    	
		return $response;
	}
  
  	$email=$_SESSION['ID'];
	$pass=$_SESSION['password'];
  	$curl_scraped_page = get('http://61.7.235.44/semester2551/Default.aspx','cookie.txt','',array('no'=>' '));
 	$html = str_get_html($curl_scraped_page);	
	$viewState = $html->find("#__VIEWSTATE")[0]->attr['value'];
	$viewStateGenerator = $html->find("#__VIEWSTATEGENERATOR")[0]->attr['value'];
	$EventValidation = $html->find("#__EVENTVALIDATION")[0]->attr['value'];

   	$result =  post('http://61.7.235.44/semester2551/Default.aspx',
			'cookie.txt',
			'http://61.7.235.44/semester2551/Default.aspx', 
			array(
				'__LASTFOCUS'=>'',
				'__EVENTTARGET'=> 'ctl00$ContentPlaceHolder1$Button1',
				'__EVENTARGUMENT' => '',
				'__VIEWSTATE' => $viewState,
				'__EVENTVALIDATION' => $EventValidation,
				'__VIEWSTATEGENERATOR' => $viewStateGenerator,
				'ctl00$ContentPlaceHolder1$TextBox1'=>$email,
				 'ctl00$ContentPlaceHolder1$TextBox2'=>$pass
			)
		);
	echo $result;
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>