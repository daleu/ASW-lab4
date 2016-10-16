<?php
ini_set("soap.wsdl_cache_enabled","0");

try{

  $sClient = new SoapClient('http://www.webservicex.net/airport.asmx?WSDL');

  // Get the necessary parameters from the request
  // Use $sClient to call the operation GetCitiesByCountry
  // echo the returned info as a JSON array of strings (city names)

  $param = $_GET["country"];
  
  $country = new stdClass();
  $country->country = $param;
  
  $result = new stdClass();
  
  $result = $sClient->GetAirportInformationByCountry($country);
  $aux = $result->GetAirportInformationByCountryResult;
  $NewDataSet = new SimpleXMLElement($aux);

  $array = array();
  foreach($NewDataSet->Table as $table) {
    $array[(string)$table->AirportCode] = (string)$table->CityOrAirportName;
  }
  ksort($array);
  
  $json = array();
  foreach($array as $code => $name) {
	  array_push($json, array("name" => $name, "code" => $code));
  }
    
  echo json_encode($json);
  
}
catch(SoapFault $e){
  header(':', true, 500);
  echo json_encode($e);
}

