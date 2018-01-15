<?php 

class CurrencyConverterComponent extends Component{
	public $currency = array("USDJSY","USDINR");
	
	public function get_rate(){
		
	/*	error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
 //ini_set('allow_url_fopen', 1);
	
		$cr = '"'.implode('","',$this->currency).'"';
		
		$options = array(
    'http' => array(
        'protocol_version' => '1.1',
        'method' => 'GET'
    )
);
$context = stream_context_create($options);
$api = "http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in (".$cr.")&env=store://datatables.org/alltableswithkeys";
//$api=urlencode($api);
$resp = fopen($api, 'r', false, $context);
		var_dump($resp);die;
		
		
		$url = "http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in (".$cr.")&env=store://datatables.org/alltableswithkeys";
		$url=urlencode($url);
	$xml = file_get_contents($url);
	 $feed = new SimpleXMLElement($xml); 
	 pr($feed);
	echo $url;

		 
		 
		 $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);      
        curl_close($ch);
        echo $o
        utput;	 
		 $curl_handle=curl_init();
  curl_setopt($curl_handle,CURLOPT_URL,$url);
  curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
  curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
  $buffer = curl_exec($curl_handle);
  

	
	echo 	curl_error($curl_handle);
		curl_close($curl_handle);
		//print file_get_contents('http://www.example.com/');
		pr($buffer);die;
		*/
	
	
	
	}
	
	
	
	
	
}
