<?php
ini_set("soap.wsdl_cache_enabled","0");

try{

  $sClient = new SoapClient('http://www.webservicex.net/airport.asmx?WSDL');

  // Get the necessary parameters from the request
  // Use $sClient to call the operation GetWeather
  // echo the returned info as a JSON object
  
  $param = $_GET["code"];
  
  $code = new stdClass();
  $code->airportCode = $param;
  
  $result = new stdClass();
  
  $result = $sClient->getAirportInformationByAirportCode($code);
  $aux = $result->getAirportInformationByAirportCodeResult;
  $NewDataSet = new SimpleXMLElement($aux);
  $table = $NewDataSet->Table[0];
  
  $array = array();
  $array["AirportCode"] = (string)$table->AirportCode;
  $array["CityOrAirportName"] = (string)$table->CityOrAirportName;
  $array["Country"] = (string)$table->Country;
  $array["CountryAbbrviation"] = (string)$table->CountryAbbrviation;
  $array["CountryCode"] = (string)$table->CountryCode;
  $array["GMTOffset"] = (string)$table->GMTOffset;
  $array["RunwayLengthFeet"] = (string)$table->RunwayLengthFeet;
  $array["RunwayElevationFeet"] = (string)$table->RunwayElevationFeet; 
  $array["LatitudeDegree"] = (string)$table->LatitudeDegree; 
  $array["LatitudeMinute"] = (string)$table->LatitudeMinute; 
  $array["LatitudeSecond"] = (string)$table->LatitudeSecond; 
  $array["LatitudeNpeerS"] = (string)$table->LatitudeNpeerS; 
  $array["LongitudeDegree"] = (string)$table->LongitudeDegree; 
  $array["LongitudeMinute"] = (string)$table->LongitudeMinute; 
  $array["LongitudeSeconds"] = (string)$table->LongitudeSeconds; 
  $array["LongitudeEperW"] = (string)$table->LongitudeEperW; 
  
  echo json_encode($array);
  
}
catch(SoapFault $e){
  header(':', true, 500);
  echo json_encode($e);
}
?>
