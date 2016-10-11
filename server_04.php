<?php
 
ini_set("soap.wsdl_cache_enabled","0");
$server = new SoapServer("http://localhost:8080/waslab04/WSLabService.wsdl");

function FahrenheitToCelsius($fdegree){
    $cresult = ($fdegree - 32) * (5/9);
    return array("cresult"=> $cresult, "timeStamp"=> date('c', time()) );
}

function CurrencyConverter($from_Currency,$to_Currency,$amount) {
	$uri = "http://currencies.apps.grandtrunk.net/getlatest/$from_Currency/$to_Currency";
	$rate = doubleval(file_get_contents($uri));
	return round($amount * $rate, 2);
};

function CurrencyConverterPlus($from_Currency) {
	$ccresult = array();
	$var_amount = $from_Currency->amount;
	$var_from_Currency = $from_Currency->from_Currency;
	for ($i = 0; $i < count($from_Currency->to_Currencies); ++$i) {
	  $ConversionResult = new stdclass();
	  $ConversionResult->currency = $from_Currency->to_Currencies[$i];
	  $ConversionResult->amount = CurrencyConverter($var_from_Currency, $from_Currency->to_Currencies[$i], $var_amount);
	  array_push($ccresult, $ConversionResult);
	}
	return $ccresult;
};

// Task #4: Implement here the CurrencyConverterPlus function and add it to $server
$server->addFunction("CurrencyConverterPlus");
// 

$server->addFunction("FahrenheitToCelsius");

// Task #3 -> Uncomment the following line:
$server->addFunction("CurrencyConverter");

$server->handle();
 
?>
