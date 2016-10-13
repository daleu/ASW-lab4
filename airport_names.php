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
  $result->GetAirportInformationByCountryResult;
  
  //echo $country;
  $result = $sClient->GetAirportInformationByCountry($country);
  $aux = $result->GetAirportInformationByCountryResult;
  $aux = new SimpleXMLElement($aux);
  $xml = new SimpleXMLElement("<airports></airports>");
  
  foreach($aux->children() as $table) {
    $item = $xml->addChild('airport');
    $item->name = $table->CityOrAirportName;
    $item->code = $table->AirportCode;
  }
  $JSON = json_encode($xml);
  echo $JSON;

}
catch(SoapFault $e){
  header(':', true, 500);
  echo json_encode($e);
}

